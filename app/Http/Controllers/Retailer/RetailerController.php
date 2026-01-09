<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Customer_order;
use App\Models\Logmaster;
use App\Models\Newpackage;
use App\Models\NhtOrder;
use App\Models\Redcliffcart;
use App\Models\Srlcart;
use App\Models\Srlorder;
use App\Models\Vendor;
use App\Models\Vendorpricenht;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <-- Import this
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Queue\Console\ForgetFailedCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use Illuminate\Support\Facades\Storage;
use PhonePe\payments\v2\standardCheckout\StandardCheckoutClient;
use PhonePe\Env;
use PhonePe\payments\v2\models\request\builders\StandardCheckoutPayRequestBuilder;

class RetailerController extends Controller
{
    public function retailerhomepage()
    {

        return view('retailer.index');

    }

    public function allpackages(Request $request)
    {

        try {

            $allpackages = Newpackage::all();

            $srlcartitems = Srlcart::all();
            $redcliffcartitems = Redcliffcart::all();

            $vendors = Vendor::all();

            $redcliffcartitems = Redcliffcart::all();

            $srlpackageIds = $srlcartitems->pluck('package_id')->toArray();
            $redcliffpackageIds = $redcliffcartitems->pluck('package_id')->toArray();

            return view('retailer.allpackagesnew', compact('allpackages', 'vendors', 'srlcartitems', 'srlpackageIds', 'redcliffcartitems', 'redcliffpackageIds'));


        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }
    }


    public function srlpincodesubmit(Request $request)
    {
        try {


            $pincode = $request->input('pincode'); // fetch from FormData
            $token = strtolower(hash('sha256', data: env('API_KEY') . '|' . $pincode . '|SRL'));

            $payload = [
                "header" => ["Token" => $token],
                "body" => ["Pincode" => $pincode, "Source" => "SHT"]
            ];


            $response = Http::withHeaders([

                'Content-Type' => 'application/json',
            ])->post('https://apiprod.agilus.in/GetCities/GetServiceableStatus', $payload);


            $response = $response->json();
            if ($response["RSP_CODE"] == 100 && $response["RSP_DESC"] = "Query Successful") {

                return view("retailer.srldateview", compact('pincode'));

            } else {

                return back()->with(["status" => "failure", "message" => "we are no orderable at this placece", "error" => ""]);

            }




        } catch (Exception $e) {
            return response()->json([

                "error" => $e->getMessage(),
            ]);


        }
    }




    public function srldatesubmit(Request $request)
    {


        $request->all();

        try {
            // ✅ FORMAT DATE EXACTLY LIKE CI
            $date = date("d-M-Y", strtotime($request->input('date')));
            $pincode = $request->input('pincode');

            // ✅ MAKE SURE API KEY IS SAME AS CI
            $apiKey = trim(env('API_KEY'));

            $token = strtolower(hash(
                'sha256',
                $apiKey . '|' . strtoupper($pincode) . '|SRL'
            ));

            $payload = [
                "header" => [
                    "Token" => $token
                ],
                "body" => [
                    "CityID" => "",
                    "Date" => $date,
                    "Pincode" => $pincode,
                    "Source" => "SHT"
                ]
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://apiprod.agilus.in/PhleboSchedule/GetPhleboScheduleDataByPincode',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                return response()->json([
                    'curl_error' => curl_error($curl)
                ], 500);
            }

            curl_close($curl);

            $responsedata = json_decode($response, true);


            if ($responsedata["RSP_CODE"] == 200) {

                $slots = $responsedata["RSP_MSG"];

                return response()->json([

                    "slots" => $slots,

                ]);


            }


        } catch (\Exception $e) {
            return response()->json([
                "status" => "failure",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


    public function srlslotsubmitdata(Request $request)
    {



        return redirect()->route('retailer.srlinfo_form')->with(["timing" => $request->slot_time, "pincode" => $request->hiddenpincode]);


    }

    public function srlformsubmit(Request $request)
    {

        try {

            $validate = $request->validate([
                "user_id" => "required|exists:users,id",
                "nht_order_id" => "nullable|string",
                "package_id" => "required|exists:newpackages,id",
                "title" => "required|string|max:10",
                "first_name" => "required|string|max:50",
                "last_name" => "required|string|max:50",
                "gender" => "required|in:Male,Female,Other",
                "dob" => "required|date|before:today",
                "email" => "required|email",
                "mobile" => "required|digits:10",
                "alternate_mobile" => "nullable|digits:10|different:mobile",
                "state" => "required|string",
                "city" => "required|string",
                "location" => "required|string",
                "pincode" => "required|digits:6",
                "dobFlag" => "nullable|boolean",
                "address" => "required|string|max:255",
                // "booking_date" => "required|date",
                "collection_date" => "nullable|string",
                "status" => "nullable|integer",
                "is_payment" => "nullable|boolean",
                "order_reference_no" => "nullable|string",
                "is_cancel_order" => "nullable|integer",
                "is_phelbo_assigned" => "nullable|string",
                "is_download_report" => "boolean|nullable",
            ]);

            $validate["booking_date"] = Carbon::today()->toDateString();
            $validate["status"] = 0;
            $validate["is_payment"] = 0;

            $order = Srlorder::create($validate);
            if ($order) {
                $inserted_id = $order->id;
                $this->lab_test_package_payment($inserted_id, $request->package_id);
            }


        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();

        } catch (Exception $e) {

            dd($e->getMessage());

            return back()->with(["error" => $e->getMessage()]);

        }


    }

    public function lab_test_package_payment($order_id, $package_id)
    {
        $user = Auth::user();
        $package = Newpackage::findOrFail($package_id);

        $order_data = [
            'user_id' => $user->id,
            'user_id_on_phonepe' => 'NHT-' . $user->id,
            'phone_pe_merchant_id' => 'M1VPZ8VOW6UH',
            'phone_pe_transaction_id' => 'TXN' . strtoupper(Str::random(10)) . time(), // More unique
            'service_name' => $package->name,
            'payment_status' => 'PAYMENT INITIATED',
            'amount_in_paise' => $package->price * 100,
        ];

        // ✅ Build request array (NOT string)
        $requestArray = [
            "merchantId" => "M1VPZ8VOW6UH",
            "merchantTransactionId" => $order_data["phone_pe_transaction_id"],
            "merchantUserId" => $order_data["user_id_on_phonepe"],
            "amount" => (int) $order_data["amount_in_paise"], // Must be integer
            "redirectUrl" => route('payment.checking', [
                'transaction' => base64_encode($order_data['phone_pe_transaction_id'])
            ]),
            "redirectMode" => "POST",
            "callbackUrl" => route('payment.verification'),
            "mobileNumber" => $user->mobile,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        // ✅ Convert to JSON first, then base64 encode
        $requestJson = json_encode($requestArray);
        $base64EncodedPayload = base64_encode($requestJson);

        // ✅ Salt key and index
        $saltKey = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
        $saltIndex = '2';

        // ✅ Generate X-VERIFY hash
        $finalValue = hash('sha256', $base64EncodedPayload . '/pg/v1/pay' . $saltKey) . '###' . $saltIndex;

        // ✅ Send POST request
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $finalValue,
            'Accept' => 'application/json'
        ])->post('https://api.phonepe.com/apis/hermes/pg/v1/pay', [
                    'request' => $base64EncodedPayload
                ]);

        if ($response->successful()) {

            // ✅ Create NHT Order
            $nhtOrder = NhtOrder::create($order_data);
            $inserted_id = $nhtOrder->id;

            // ✅ Update srl_orders table with correct ID (not whole object)
            Srlorder::where("id", $order_id)->update([
                "nht_order_id" => $nhtOrder->id, // ✅ Use ID, not object
                "package_id" => $package_id,
            ]);

            // ✅ Check if response has redirect URL
            $responseData = $response->json();

            if (isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                $redirectUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
                return redirect()->away($redirectUrl);
            } else {
                return back()->with('error', 'Payment URL not found. Please try again.');
            }

        } else {
            // ✅ Log error for debugging
            \Log::error('PhonePe Payment Failed', [

                'response' => $response->json(),
                'status' => $response->status(),
            ]);

            return back()->with('error', 'Payment initiation failed. Please try again.');
        }
    }




    public function redcliffpincodesubmit(Request $request)
    {

        try {

            $houseNo = "123";
            $city = "Delhi";
            $pincode = "110001";

            $placeQuery = "{$houseNo},{$city},{$pincode}";
            $apiUrl = "https://api.redcliffelabs.com/api/partner/v2/get-partner-location-2-eloc/?place_query={$placeQuery}";

            $response = Http::withHeaders([
                'key' => 'PutkOEaLCumXD2t0054W6BW4VvFY4odj'
            ])->timeout(0)->get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();

            } else {
                dd($response->body());
            }


        } catch (Exception $e) {
            return response()->json([

                "error" => $e->getMessage(),
            ]);

        }

    }


    public function srlcartopen(Request $request)
    {
        try {
            $package_id = $request->input('package_id');
            $vendor_id = $request->input('vendor_id');

            if (!$package_id || !$vendor_id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid input'
                ], 422);
            }

            $package = Newpackage::findOrFail($package_id);

            $srlcart = Srlcart::create([
                'package_id' => $package_id,
                'vendor_id' => $vendor_id,
                "user_id" => Auth::user()->id,
            ]);


            //this is correct
            $srlitems = Srlcart::all();


            return response()->json([
                'status' => 'success',
                'message' => 'Test added to the SRL cart',
                'package_id' => $package->id,
                'srlcart' => $srlitems,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function checking_payment_status_for_srl($transaction_id)
    {

        $data['page'] = 'checking-payment-status';
        $transaction_id = base64_decode($transaction_id);


        $transactiondata = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->first();


        if (!empty($transactiondata)) {

            $url_string = '/pg/v1/status/M1VPZ8VOW6UH/' . $transaction_id;
            $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
            $salt_index = '2';
            $verify_value = hash('sha256', $url_string . $salt_key) . '###' . $salt_index;

            $url = 'https://api.phonepe.com/apis/hermes/pg/v1/status/M1VPZ8VOW6UH/' . $transaction_id;

            $response = Http::withHeaders([
                'X-VERIFY' => $verify_value,
                'accept' => 'application/json',
                'X-MERCHANT-ID' => 'M1VPZ8VOW6UH',
            ])->get($url);

            $payment_response = $response->json(); // array response

            if ($payment_response->success) {
                $arr = array('phone_pe_transaction_id' => $transaction_id);
                $data = array('payment_status' => 'PAYMENT SUCCESS');
                $order = NhtOrder::where('phone_pe_transaction_id', $transaction_id)->first();

                if ($order) {

                    $order->update([
                        'payment_status' => 'PAYMENT SUCCESS',
                    ]);

                }



            }


        }

    }

    public function redcliffcart(Request $request)
    {

        try {

            $package_id = $request->input('package_id');
            $vendor_id = $request->input('vendor_id');


            if (!$package_id || !$vendor_id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid input'
                ], 422);
            }

            $package = Newpackage::findOrFail($package_id);
            $vendornhtprice = Vendorpricenht::where("package_id", $package_id)->where("vendor_id", $vendor_id)->first();

            $redcliffcart = Redcliffcart::create([
                'package_id' => $package_id,
                'vendor_id' => $vendor_id,
                "user_id" => Auth::user()->id,
                "price" => $vendornhtprice->nht_price,

            ]);

            //this is correct
            $redcliffitems = Redcliffcart::all();

            return response()->json([

                'status' => 'success',
                'message' => 'Test added to the Redcliff  cart',
                'package_id' => $package->id,
                'redcliffcart' => $redcliffitems,

            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);


        }



    }

    public function redcliffcartview()
    {

        $cartItems = Redcliffcart::get(['package_id', 'vendor_id']);

        $redcliffcartitems = Vendorpricenht::where(function ($query) use ($cartItems) {
            foreach ($cartItems as $item) {
                $query->orWhere(function ($q) use ($item) {
                    $q->where('package_id', $item->package_id)
                        ->where('vendor_id', $item->vendor_id);
                });
            }
        })->get();


        return view("retailer.redcliffcartview", compact('redcliffcartitems'));

    }


    public function individualpackage(Request $request)
    {

        try {

            $package_id = $request->id;
            $package = Newpackage::where("id", $package_id)->first();
            $vendordetails = Vendorpricenht::where("package_id", $package_id)->get();
            $recliffcartpackages_ids = Redcliffcart::pluck('package_id')->toArray();




            $data = [];
            foreach ($vendordetails as $vendor) {
                if ($vendor->vendor_id == "1") {

                    $data["redcliff"] = ["package_id" => $vendor->package_id, "price" => $vendor->nht_price, "package_code" => $vendor->package_code, "vendor_id" => $vendor->vendor_id];

                } else if ($vendor->vendor_id == "2") {

                    $data["srl"] = ["package_id" => $vendor->package_id, "price" => $vendor->nht_price, "package_code" => $vendor->package_code, "vendor_id" => $vendor->vendor_id];

                } else if ($vendor->vendor_id == "3") {

                    $data["tata1mg"] = ["package_id" => $vendor->package_id, "price" => $vendor->nht_price, "package_code" => $vendor->package_code, "vendor_id" => $vendor->vendor_id];

                }


            }




            return view("retailer.individualpackage", compact('package', 'data', 'recliffcartpackages_ids'));


        } catch (Exception $e) {



        }

    }

    public function getLocationDetails($eloc, Request $request)
    {

        $url = "https://api.redcliffelabs.com/api/partner/v2/get-partner-loc-2-eloc/?eloc=" . urlencode($eloc);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                "key: pW2woxd83m29ihJUlIRM9oxKnylbPt4a",
                "Accept: application/json"
            ],
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            dd('Curl Error:', curl_error($ch));
        }

        curl_close($ch);

        // 🔍 Decode response
        $decodedResponse = json_decode($response, true);



        // ✅ DUMP & DIE
        if ($decodedResponse["status"] == "success") {
            $latitude = $decodedResponse['latitude'];
            $longitude = $decodedResponse['longitude'];
            $pincode = $request->query('pincode');

            $response = Http::withHeaders([
                'key' => 'pW2woxd83m29ihJUlIRM9oxKnylbPt4a',
                'Accept' => 'application/json',
            ])->get('https://api.redcliffelabs.com/api/center/v2/is-location-serviceable/', [
                        'longitude' => $longitude,
                        'latitude' => $latitude,
                    ]);



            if ($response->failed()) {

                $responseData = $response->json();

                return back()->with([
                    'status' => 'failure',
                    'message' => $responseData['message'] ?? 'Something went wrong. Please try again.'
                ]);
            }


            // ✅ decoded response array
            $serviceabilityData = $response->json();


            if ($serviceabilityData["status"] = "success") {

                return view("retailer.redcliffdateview", compact('latitude', 'longitude', 'pincode'));



            } else {





            }


        } else {





        }
    }

    public function redcliffdates(Request $request)
    {

        $date = $request->date;
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $response = Http::withHeaders([
            'key' => 'pW2woxd83m29ihJUlIRM9oxKnylbPt4a',
        ])->get('https://api.redcliffelabs.com/api/booking/v2/get-time-slot-list/', [
                    'collection_date' => $date,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);

        // ❌ API or network error
        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'API request failed',
                'error' => $response->body()
            ], 500);
        }

        $decodedResponse = $response->json();

        // ✅ Success
        if (isset($decodedResponse['status']) && $decodedResponse['status'] === 'success') {
            return response()->json($decodedResponse, 200);
        }

        // ❌ API failure
        return response()->json([

            'status' => 'failure',
            'message' => $decodedResponse['message'] ?? 'No slots available',
            'data' => $decodedResponse

        ], 400);
    }


    public function redclifftimeslotsubmit(Request $request)
    {

        try {

            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $pincode = $request->redcliffpincode;
            $collection_date = $request->redcliffdate;
            $collection_slot_id = $request->timeSlot;

            return view('retailer.redcliffbookingdetail', compact('latitude', 'longitude', 'pincode', 'collection_date', 'collection_slot_id'));


        } catch (ValidationException $e) {

            return back()->with($e->errors());


        }

        return view('retailer.redcliffbookingdetail');

    }


    public function red_cliffe_order_placed(Request $request)
    {

        try {


            $package_ids = Redcliffcart::where("user_id", Auth()->user()->id)->pluck('package_id');

            $order_data = [

                'user_id' => Auth::user()->id, // Laravel way to get logged-in user ID
                'collection_slot_id' => $request->collection_slot_id,
                'booking_id' => 0, // Set default or get from API response later
                'pk' => 0, // Set default or get from API response later
                'customer_name' => $request->customer_name,
                'customer_gender' => $request->customer_gender,
                'customer_phonenumber' => $request->customer_phonenumber,
                'customer_whatsappnumber' => $request->customer_whatsappnumber,
                'customer_age' => $request->customer_age,
                "customer_packages" => $package_ids,
                'booking_date' => $request->booking_date,
                'collection_date' => $request->collection_date,
                'pincode' => $request->pincode,
                'customer_address' => $request->customer_address,
                'customer_landmark' => $request->customer_landmark,
                'customer_latitude' => $request->customer_latitude,
                'customer_longitude' => $request->customer_longitude,
                'status' => 0,
                'is_payment' => 0,
                'is_credit' => true,
            ];


            $order = Customer_order::create($order_data);

            if ($order) {
                $inserted_id = $order->id;
                $this->lab_test_package_payment_for_redclif($inserted_id);

            } else {

            }



        } catch (Exception $e) {




            dd($e->getMessage());



        }


    }



    protected function lab_test_package_payment_for_redclif($inserted_id)
    {
        try {

            // 1️⃣ Calculate total price (paise-safe)
            $totalPrice = (int) Redcliffcart::where('user_id', Auth::id())->sum('price');

            if ($totalPrice <= 0) {
                abort(400, 'Invalid cart amount');
            }

            // 2️⃣ Prepare order data
            $order_data = [
                "user_id" => Auth::id(),
                "user_id_on_phonepe" => "NHT-" . Auth::id(),
                "phone_pe_merchant_id" => "M1VPZ8VOW6UH",
                "phone_pe_transaction_id" => strtoupper($this->generateUniqueTrstID(10)),
                "amount_in_paise" => $totalPrice * 100, // If price is in ₹, multiply by 100
                "payment_status" => "PAYMENT INITIATED",
                "customer_id" => $inserted_id,
            ];


            // // 8️⃣ Save order BEFORE redirect
            // $userpackages = Redcliffcart::where('user_id', Auth::id())->pluck('package_id');

            // $order_data['package_ids'] = $userpackages;

            $order = NhtOrder::create($order_data);




            $nhtorderid = $order->id;

            Customer_order::where("id", $inserted_id)->update([
                "nht_order_id" => $nhtorderid,
            ]);



            // 3️⃣ Initialize PhonePe client
            $clientId = "M1VPZ8VOW6UH_25120913183"; // Your Client ID
            $clientVersion = 1;                       // Client Version
            $clientSecret = "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0"; // Client Secret
            $env = Env::UAT;

            $client = StandardCheckoutClient::getInstance(
                $clientId,
                $clientVersion,
                $clientSecret,
                $env
            );

            // 4️⃣ Prepare payment request
            $merchantOrderId = $order_data["phone_pe_transaction_id"];
            $amount = $order_data["amount_in_paise"];
            $redirectUrl = route(
                'retailer.checking_payment_status_redcliffe',
                ['transaction_id' => encrypt($merchantOrderId)]
            );
            $message = "Your order details";

            $payRequest = StandardCheckoutPayRequestBuilder::builder()
                ->merchantOrderId($merchantOrderId)
                ->amount($amount)
                ->redirectUrl($redirectUrl)
                ->message($message)  // Optional message
                ->build();

            // 5️⃣ Call PhonePe API
            try {

                $payResponse = $client->pay($payRequest);

                if ($payResponse->getState() === "PENDING") {
                    // Redirect user to PhonePe payment page
                    header("Location: " . $payResponse->getRedirectUrl());
                    exit();
                } else {
                    // Handle errors
                    echo "Payment initiation failed: " . $payResponse->getState();
                }

            } catch (\PhonePe\common\exceptions\PhonePeException $e) {
                // Handle exceptions
                echo "Error initiating payment: " . $e->getMessage();
            }



        } catch (\Exception $e) {
            return back()->with(["status" => "failure", "message" => $e->getMessage()]);
        }
    }

    public function checking_payment_status_redcliffe($transaction_id)
    {


        // Decrypt transaction ID
        $transaction_id = decrypt($transaction_id);
        // Find transaction data
        $transaction_data = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->first();

        if (empty($transaction_data)) {
            return redirect()->route('retailer.allpackages')
                ->with(["status" => "failure", "message" => "Sometthing went Wrong"]);
        }


        $clientId = "M1VPZ8VOW6UH_25120913183"; // Your Client ID
        $clientVersion = 1;                       // Client Version
        $clientSecret = "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0"; // Client Secret
        $env = Env::UAT;




        $client = StandardCheckoutClient::getInstance(
            $clientId,
            $clientVersion,
            $clientSecret,
            $env
        );


        $merchantOrderId = $transaction_id; // Replace with the order ID you want to check


        try {

            $statusCheckResponse = $client->getOrderStatus($merchantOrderId, true);

            // dd([
            //     'order_id' => $statusCheckResponse->orderId,
            //     'state' => $statusCheckResponse->state,
            //     'amount' => $statusCheckResponse->amount,
            //     'expire_at' => $statusCheckResponse->expireAt,
            //     'payment_details' => $statusCheckResponse->paymentDetails,

            //     // first payment detail (most important)
            //     'transaction_id' => $statusCheckResponse->paymentDetails[0]->transactionId ?? null,
            //     'payment_mode' => $statusCheckResponse->paymentDetails[0]->paymentMode ?? null,
            //     'payment_state' => $statusCheckResponse->paymentDetails[0]->state ?? null,
            // ]);





            if (!$transaction_data) {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'No orders found for this transaction');
            }

            // Update payment status for all related orders

            // Create log entry before update
            $log = [
                "table_name" => "nht_orders",
                "main_id_number" => $transaction_data->id,
                "data_before_updation" => json_encode($transaction_data->toArray())
            ];

            $logmaster = Logmaster::create($log);

            if ($logmaster) {
                // Update payment status
                $transaction_data->update(['payment_status' => "PAYMENT SUCCESS"]);

                // Log data after update
                $newdata = NhtOrder::find($transaction_data->id);
                $logmaster->update([
                    "data_after_updation" => json_encode($newdata->toArray())
                ]);
            }


            $nht_order_id = $transaction_data->id;

            // Get customer order details
            $customer_data = Customer_order::where("nht_order_id", $nht_order_id)->first();

            $package_codes = Vendorpricenht::whereIn(
                'package_id',
                $customer_data->customer_packages
            )
                ->where('vendor_id', 1)
                ->pluck('package_code')
                ->toArray();

            if (!$customer_data) {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'Customer order not found');
            }

            // Prepare payload for Redcliffe API
            $payload = [
                "booking_date" => $customer_data->booking_date,
                "collection_date" => $customer_data->collection_date,
                "collection_slot" => $customer_data->collection_slot_id,
                "customer_address" => $customer_data->customer_address,
                "customer_age" => $customer_data->customer_age,
                "customer_altphonenumber" => $customer_data->customer_whatsappnumber,
                "customer_gender" => $customer_data->customer_gender,
                "customer_latitude" => $customer_data->customer_latitude,
                "customer_longitude" => $customer_data->customer_longitude,
                "customer_name" => $customer_data->customer_name,
                "customer_phonenumber" => $customer_data->customer_phonenumber,
                "customer_whatsapppnumber" => $customer_data->customer_whatsappnumber,
                "is_credit" => true,
                "landmark" => $customer_data->customer_landmark,
                "package_code" => $package_codes,
                true,
                "pincode" => $customer_data->pincode,
                "additional_member" => [],
            ];



            // Create booking at Redcliffe
            $bookingResponse = Http::withHeaders([
                'key' => 'aU8MOnfONIgMrM9q1eRB8WFbvoBEj1wN',
                'Content-Type' => 'application/json',
            ])
                ->timeout(120)
                ->post(
                    'https://apiqa.redcliffelabs.com/api/external/v2/center-create-booking/',
                    $payload
                );

            $bookingResponseData = $bookingResponse->json();



            if (!isset($bookingResponseData['status']) || $bookingResponseData['status'] !== 'success') {
                return redirect()->route('retailer.allpackages')
                    ->with(["status" => $bookingResponseData["status"], "message" => $bookingResponseData["message"]]);
            }



            // Check if booking creation was successful
            if (!isset($bookingResponseData['status']) || $bookingResponseData['status'] !== 'success') {
                return redirect()->route('retailer.allpackages')
                    ->with('error', $bookingResponseData["message"]);
            }

            $booking_id = $bookingResponseData["booking_id"];


            // $this->writeToLog($create_booking, 'create_redcliff_booking', 'create_redcliff_booking');



            // Update customer order with booking ID
            Customer_order::where("nht_order_id", $nht_order_id)->update([
                "booking_id" => $booking_id,
                "pk" => $booking_id,
            ]);

            // Confirm the booking
            $confirmResponse = Http::withHeaders([
                'key' => 'aU8MOnfONIgMrM9q1eRB8WFbvoBEj1wN',
                'Content-Type' => 'application/json',
            ])
                ->timeout(60)
                ->post(
                    'https://apiqa.redcliffelabs.com/api/external/v2/center-confirm-booking/',
                    [
                        "booking_id" => $booking_id,
                        "is_confirmed" => true
                    ]
                );

            $confirmResponseData = $confirmResponse->json();

            if (!isset($confirmResponseData['status']) || $confirmResponseData['status'] !== 'success') {
                return redirect()->route('retailer.allpackages')
                    ->with(["status" => $confirmResponse["status"], "message" => $confirmResponseData["message"]]);
            }




            // Log all API interactions
            $logs = [

                "details_enter_api" => $payload,
                "details_enter_api_response" => $bookingResponseData,
                "confirmation_booking_api" => $booking_id,
                "confirmation_booking_api_response" => $confirmResponseData,

            ];

            $this->writeToLog($logs, 'bookings', 'redcliffe bookings');


            // Check if confirmation was successful
            if (!isset($confirmResponseData['status']) || $confirmResponseData['status'] !== 'success') {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'Booking confirmation failed');
            }

            // Clear session and regenerate token for security
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            // Redirect to invoice with cache prevention headers
            return redirect()->route("retailer.invoice")->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);


        } catch (\PhonePe\common\exceptions\PhonePeException $e) {

            dd([
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }








    }





    public function Payment_and_finalbooking_controller(Request $request)
    {



    }

    protected function writeToLog($data, $directry, $title = '')
    {
        $pagename = date('Y-m-d');
        $directory = $directry; // e.g. 'redlicfff'
        $filePath = $directory . '/' . $pagename . '.log';

        // Ensure directory exists (PUBLIC)
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // If file doesn't exist, create it
        if (!Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->put($filePath, 'Log file created');
        }

        // Prepare log content
        $log = "\n------------------------------------------------------------------------------------------------\n";
        $log .= date('Y-m-d H:i:s') . "\n";
        $log .= !empty($title) ? $title : 'DEBUG';
        $log .= "\n" . print_r($data, true);
        $log .= "\n------------------------------------------------------------------------------------------------\n";

        // Append log (PUBLIC)
        Storage::disk('public')->append($filePath, $log);

        return true;
    }

    protected function createFile($filePath)
    {
        $defaultContent = 'File Created';
        Storage::put($filePath, $defaultContent);
    }




    protected function generateUniqueTrstID($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $maxIndex)];
        }


        return $randomString;
        // $res = get_table_data($randomString, 'phone_pe_transaction_id', 'nht_orders', 'id', 'id');

        // if (!empty($res)) {
        //     generateUniqueTrstID($length);
        // } else {
        //     return $randomString;
        // }
    }
    public function invoice_generation()
    {

        return view("retailer.invoice");



    }


}
