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
            $redcliffitems = Redcliffcart::all();

            return view("retailer.individualpackage", compact('package', 'data', 'recliffcartpackages_ids','redcliffitems'));
       

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
                "amount_in_paise" => $totalPrice * 100,
                "payment_status" => "PAYMENT INITIATED",
                "customer_id" => $inserted_id,
            ];

            // 3️⃣ PhonePe payload
            $payload = [
                "merchantId" => $order_data['phone_pe_merchant_id'],
                "merchantTransactionId" => $order_data['phone_pe_transaction_id'],
                "merchantUserId" => $order_data['user_id_on_phonepe'],
                "amount" => $order_data['amount_in_paise'],
                "redirectUrl" => route(
                    'retailer.checking_payment_status_redcliffe',
                    ['transaction_id' => encrypt($order_data['phone_pe_transaction_id'])]
                ),
                "redirectMode" => "POST",
                "callbackUrl" => url('/payment/phonepe/callback'),
                "mobileNumber" => "7754093527",
                "paymentInstrument" => [
                    "type" => "PAY_PAGE"
                ]
            ];

            $base64Payload = base64_encode(json_encode($payload));

            $saltKey = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
            $saltIndex = '2';

            $checksum = hash('sha256', $base64Payload . '/pg/v1/pay' . $saltKey)
                . '###' . $saltIndex;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
                'X-VERIFY' => $checksum,
                'X-MERCHANT-ID' => $payload['merchantId'],
            ])->post(
                    'https://api.phonepe.com/apis/hermes/pg/v1/pay',
                    ['request' => $base64Payload]
                );

            // if (!$response->successful()) {
            //     dd($response->body());
            //     throw new \Exception($response->body());
            // }

            // ✅ Http::post()->json() already returns array
            $responseData = $response->json();



            // 8️⃣ Save order BEFORE redirect
            $userpackages = Redcliffcart::where('user_id', Auth::id())->pluck('package_id');

            $order_data['package_ids'] = $userpackages;

            $order = NhtOrder::create($order_data);


            $nhtorderid = $order->id;

            Customer_order::where("id", $inserted_id)->update([
                "nht_order_id" => $nhtorderid,
            ]);

            // 9️⃣ Redirect to PhonePe payment page
            return redirect(
                $responseData['data']['instrumentResponse']['redirectInfo']['url']
            );

        } catch (\Exception $e) {
            return back()->with(["status" => "failure", "message" => $e->getMessage()]);
        }
    }

    public function checking_payment_status_redcliffe($transaction_id)
    {
        try {
            // Decrypt transaction ID
            $transaction_id = decrypt($transaction_id);

            // Find transaction data
            $transaction_data = NhtOrder::where("phone_pe_merchant_id", $transaction_id)->first();

            if (empty($transaction_data)) {
                return redirect()->route('retailer.allpackages')
                    ->with(["status" => "failure", "message" => "Sometthing went Wrong"]);
            }

            // PhonePe API Configuration
            $merchant_id = 'M1VPZ8VOW6UH';
            $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
            $salt_index = '2';

            // Generate verification hash
            $url_string = "/pg/v1/status/{$merchant_id}/{$transaction_id}";
            $verify_value = hash('sha256', $url_string . $salt_key) . '###' . $salt_index;

            // Make API request to PhonePe
            $response = Http::withHeaders([
                'X-VERIFY' => $verify_value,
                'accept' => 'application/json',
                'X-MERCHANT-ID' => $merchant_id
            ])
                ->timeout(30)
                ->get("https://api.phonepe.com/apis/hermes/pg/v1/status/{$merchant_id}/{$transaction_id}");

            $responseData = $response->json();

            // Check if payment was successful
            if (!isset($responseData['success']) || !$responseData['success']) {
                return redirect()->route('retailer.allpackages')
                    ->with(["status" => "failure", "message" => "Payment Verification failed"]);
            }

            // Get all orders with this transaction ID
            $results = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->get();

            if ($results->isEmpty()) {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'No orders found for this transaction');
            }

            // Update payment status for all related orders
            foreach ($results as $result) {
                // Create log entry before update
                $log = [
                    "table_name" => "nht_orders",
                    "main_id_number" => $result->id,
                    "data_before_updation" => json_encode($result->toArray())
                ];

                $logmaster = Logmaster::create($log);

                if ($logmaster) {
                    // Update payment status
                    $result->update(['payment_status' => "PAYMENT SUCCESS"]);

                    // Log data after update
                    $newdata = NhtOrder::find($result->id);
                    $logmaster->update([
                        "data_after_updation" => json_encode($newdata->toArray())
                    ]);
                }
            }

            // Get the latest transaction data
            $latest_transaction_data = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->first();

            if (!$latest_transaction_data) {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'Transaction data not found');
            }

            $nht_order_id = $latest_transaction_data->id;

            // Get customer order details
            $customer_data = Customer_order::where("nht_order_id", $nht_order_id)->first();

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
                "package_code" => json_decode($customer_data->customer_packages, true),
                "pincode" => $customer_data->pincode,
                "additional_member" => [],
            ];

            // Create booking at Redcliffe
            $bookingResponse = Http::withHeaders([
                'key' => 'PutkOEaLCumXD2t0054W6BW4VvFY4odj',
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post(
                    'https://api.redcliffelabs.com/api/external/v2/center-create-booking/',
                    $payload
                );

            $bookingResponseData = $bookingResponse->json();

            // Check if booking creation was successful
            if (!isset($bookingResponseData['status']) || $bookingResponseData['status'] !== 'success') {
                return redirect()->route('retailer.allpackages')
                    ->with('error', 'Booking creation failed at Redcliffe');
            }

            $booking_id = $bookingResponseData["booking_id"];

            // Update customer order with booking ID
            Customer_order::where("nht_order_id", $nht_order_id)->update([
                "booking_id" => $booking_id,
                "pk" => $booking_id,
            ]);

            // Confirm the booking
            $confirmResponse = Http::withHeaders([
                'key' => 'PutkOEaLCumXD2t0054W6BW4VvFY4odj',
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post(
                    'https://api.redcliffelabs.com/api/external/v2/center-confirm-booking/',
                    [
                        "booking_id" => $booking_id,
                        "is_confirmed" => true
                    ]
                );

            $confirmResponseData = $confirmResponse->json();

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

        } catch (DecryptException $e) {
            Log::error('Decryption failed for transaction: ' . $e->getMessage());
            return redirect()->route('retailer.allpackages')
                ->with('error', 'Invalid transaction ID');

        } catch (Exception $e) {
            Log::error('Payment status check failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->route('retailer.allpackages')
                ->with('error', 'An error occurred while processing your payment. Please contact support.');
        }
    }


    // public function checking_payment_status_redcliffe($transaction_id)
    // {


    //     try {

    //         $data['page'] = 'checking-payment-status';
    //         $transaction_id = decrypt($transaction_id);
    //         $transaction_data = NhtOrder::where("phone_pe_merchant_id", $transaction_id)->get();

    //         if (!empty($transaction_data)) {

    //             $url_string = '/pg/v1/status/M1VPZ8VOW6UH/' . $transaction_id;

    //             $salt_key = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
    //             $salt_index = '2';
    //             $verify_value = hash('sha256', $url_string . $salt_key) . '###' . $salt_index;
    //             $curl = curl_init();

    //             curl_setopt_array(
    //                 $curl,
    //                 array(
    //                     CURLOPT_URL => 'https://api.phonepe.com/apis/hermes/pg/v1/status/M1VPZ8VOW6UH/' . $transaction_id,
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => '',
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => 'GET',
    //                     CURLOPT_HTTPHEADER => array(
    //                         'X-VERIFY: ' . $verify_value,
    //                         'accept: application/json',
    //                         'X-MERCHANT-ID: M1VPZ8VOW6UH'
    //                     ),
    //                 )
    //             );

    //             $response = curl_exec($curl);

    //             curl_close($curl);

    //             $response = json_decode($response);

    //             if ($response->success) {

    //                 $results = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->get();
    //                 foreach ($results as $result) {

    //                     $log["table_name"] = "nht_orders";
    //                     $log["main_id_number"] = $result->id;
    //                     $log["main_id_number"] = json_encode($result);
    //                     $logmaster = Logmaster::create($log);
    //                     $inserted_id = $logmaster->id;

    //                     if ($logmaster) {

    //                         $updatenhtorder = NhtOrder::where("id", $result->id)->update([

    //                             'payment_status' => "PAYMENT SUCCESS"
    //                         ]);


    //                         if ($updatenhtorder) {
    //                             $newdata = NhtOrder::where("id", $result->id)->first();
    //                             $log_data["data_after_updation"] = json_encode($newdata);
    //                             Logmaster::where("id", $inserted_id)->update($log_data);



    //                         }
    //                     }

    //                 }

    //                 $latest_tranascation_data = NhtOrder::where("phone_pe_transaction_id", $transaction_id)->first();
    //                 $nht_order_id = $latest_tranascation_data->id;

    //                 $customer_data = Customer_order::where("nht_order_id", $nht_order_id)->first();

    //                 if ($customer_data) {

    //                     $payload = [
    //                         "booking_date" => $customer_data->booking_date,
    //                         "collection_date" => $customer_data->collection_date,
    //                         "collection_slot" => $customer_data->collection_slot_id,
    //                         "customer_address" => $customer_data->customer_address,
    //                         "customer_age" => $customer_data->customer_age,
    //                         "customer_altphonenumber" => $customer_data->customer_whatsappnumber,
    //                         "customer_gender" => $customer_data->customer_gender,
    //                         "customer_latitude" => $customer_data->customer_latitude,
    //                         "customer_longitude" => $customer_data->customer_longitude,
    //                         "customer_name" => $customer_data->customer_name,
    //                         "customer_phonenumber" => $customer_data->customer_phonenumber,
    //                         "customer_whatsapppnumber" => $customer_data->customer_whatsappnumber,
    //                         "is_credit" => true,
    //                         "landmark" => $customer_data->customer_landmark,
    //                         "package_code" => [$customer_data->package_code],
    //                         "pincode" => $customer_data->pincode,
    //                         "additional_member" => [],
    //                     ];

    //                     $response = Http::withHeaders([
    //                         'key' => 'PutkOEaLCumXD2t0054W6BW4VvFY4odj',
    //                         'Content-Type' => 'application/json',
    //                     ])
    //                         ->timeout(30)
    //                         ->post(
    //                             'https://api.redcliffelabs.com/api/external/v2/center-create-booking/',
    //                             $payload

    //                         );

    //                     // Convert response to array
    //                     $response1 = $response->json();
    //                     if (isset($response1['status']) && $response1['status'] === 'success') {
    //                         $booking_id = $response1["booking_id"];


    //                         Customer_order::where("nht_order_id", $nht_order_id)->update([

    //                             "booking_id" => $booking_id,
    //                             "pk" => $booking_id,
    //                         ]);

    //                         $confirmResponse = Http::withHeaders([
    //                             'key' => 'PutkOEaLCumXD2t0054W6BW4VvFY4odj',
    //                             'Content-Type' => 'application/json',
    //                         ])
    //                             ->timeout(30)
    //                             ->post(
    //                                 'https://api.redcliffelabs.com/api/external/v2/center-confirm-booking/',
    //                                 [
    //                                     "booking_id" => $booking_id,
    //                                     "is_confirmed" => true
    //                                 ]
    //                             );

    //                         // Same as: json_decode($response, true)
    //                         $response = $confirmResponse->json();

    //                         $logs = array(
    //                             "details_enter_api" => $payload,
    //                             "details_enter_api_response" => $response1,
    //                             "confirmationn_booking_api" => $booking_id,
    //                             "confirmationn_booking_api_response" => $response,
    //                         );


    //                         $this->writeToLog($logs, 'bookings', 'redclif bookings');


    //                         if ($response['status'] == "success") {


    //                             return redirect()->route("retailer.invoice");



    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     } catch (Exception $e) {



    //     }

    // }


    public function Payment_and_finalbooking_controller(Request $request)
    {



    }

    protected function writeToLog($data, $directry, $title = '')
    {
        $pagename = date("Y-m-d");
        $filePath = $directry . '/' . $pagename . '.log';

        // Ensure directory exists
        if (!Storage::exists($directry)) {
            Storage::makeDirectory($directry, 0777, true);
        }

        // If file doesn't exist, create it
        if (!Storage::exists($filePath)) {
            $this->createFile($filePath);
        }

        // Prepare log content
        $log = "\n------------------------------------------------------------------------------------------------\n";
        $log .= date("Y.m.d G:i:s") . "\n";
        $log .= strlen($title) > 0 ? $title : 'DEBUG';
        $log .= "\n" . print_r($data, true);
        $log .= "\n------------------------------------------------------------------------------------------------\n";

        // Append log
        Storage::append($filePath, $log);

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
