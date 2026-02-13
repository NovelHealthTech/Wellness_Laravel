<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Customer_order;
use App\Models\Logmaster;
use App\Models\Newpackage;
use App\Models\NhtOrder;
use App\Models\Nhtorder as ModelsNhtorder;
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



            $srlpackageIds = $srlcartitems->pluck('package_id')->toArray();
            $redcliffpackageIds = $redcliffcartitems->pluck('package_id')->toArray();

            return view('retailer.allpackagesnew', compact('allpackages', 'vendors', 'srlcartitems', 'srlpackageIds', 'redcliffcartitems', 'redcliffpackageIds', 'srlcartitems'));


        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }
    }


    public function srlpincodesubmit(Request $request)
    {
        try {


            $pincode = $request->input('pincode'); // fetch from FormData
            // $token = strtolower(hash('sha256', data: env('API_KEY') . '|' . $pincode . '|SRL'));
            $token = "db32296dee3e80d5c1fba27ce9d0e3acaf58e51ccbdb40e8ceed15683d335e93";

            $payload = [
                "header" => ["Token" => $token],
                "body" => ["Pincode" => $pincode, "Source" => "SHT"]
            ];

            $response = Http::withHeaders([

                'Content-Type' => 'application/json',
            ])->post('https://apiuat.agilus.in/GetCities/GetServiceableStatus', $payload);

            if ($response["RSP_CODE"] == 100 && $response["RSP_DESC"] == "Query Successful") {


                return view("retailer.srldateview", compact('pincode'));

            } else {



                return back()->with(["status" => "failure", "message" => "we are not orderable at this place", "error" => ""]);

            }




        } catch (Exception $e) {
            return response()->json([

                "error" => $e->getMessage(),
            ]);


        }
    }




    public function srldatesubmit(Request $request)
    {




        try {
            // ✅ FORMAT DATE EXACTLY LIKE CI
            $date = date("d-M-Y", strtotime($request->input('date')));
            $pincode = $request->input('pincode');

            // ✅ MAKE SURE API KEY IS SAME AS CI
            $apiKey = trim(env('API_KEY'));

            // $token = strtolower(hash(
            //     'sha256',
            //     $apiKey . '|' . strtoupper($pincode) . '|SRL'
            // ));
            $token = "1e8aa5d79c4273bcc4c30ebb50cf1f54c862b585e54a37cdc1a1b3a6eaec8e5f";

            $payload = [
                "header" => [
                    "Token" => $token
                ],
                "body" => [
                    "CityID" => "",
                    "Date" => "24-NOV-2022",
                    "Pincode" => "400063",
                    "Source" => "SHT"
                ]
            ];


            // $api_prod="https://apiprod.agilus.in/PhleboSchedule/GetPhleboScheduleDataByPincode";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post(
                    'https://apiuat.agilus.in/PhleboSchedule/GetPhleboScheduleDataByPincode',
                    $payload
                );


            if (!$response->successful()) {
                throw new \Exception('API Error: ' . $response->body());
            }

            $responsedata = $response->json();

            if ($responsedata["RSP_CODE"] == 200) {
                $slots = $responsedata["RSP_MSG"];

                return response()->json([

                    "slots" => $slots,

                ]);

            }




        } catch (\Exception $e) {

            return response()->json(
                [
                    "status" => "failure",
                    "error" => $e->getMessage(),

                ],
                500
            );

        }
    }


    public function srlslotsubmitdata(Request $request)
    {



        return redirect()->route('retailer.srlinfo_form')->with(["timing" => $request->slot_time, "pincode" => $request->hiddenpincode]);


    }

    public function srlformsubmit(Request $request)
    {
        try {

            // ✅ Validation
            $package_ids = Srlcart::where("user_id", Auth::user()->id)->pluck("package_id");

            $validate = $request->validate([
                "user_id" => "required|exists:users,id",
                "nht_order_id" => "nullable|string",
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
                "collection_date" => "nullable|string",
                "status" => "nullable|integer",
                "is_payment" => "nullable|boolean",
                "order_reference_no" => "nullable|string",
                "is_cancel_order" => "nullable|integer",
                "is_phelbo_assigned" => "nullable|string",
                "is_download_report" => "nullable|boolean",
            ]);
            $validate["package_ids"] = $package_ids;

            // ✅ Default values
            $validate["booking_date"] = Carbon::today()->toDateString();
            $validate["status"] = 0;
            $validate["is_payment"] = 0;

            // ✅ Create SRL Order
            $order = Srlorder::create($validate);

            if (!$order) {
                return back()->with([
                    "status" => "failure",
                    "message" => "Order creation failed"
                ]);
            }

            $inserted_id = $order->id;

            // ✅ Calculate cart total
            $totalPrice = (int) Srlcart::where('user_id', Auth::id())->sum('price');

            // ✅ Create NHT Order
            $order_data = [
                "user_id" => Auth::id(),
                "user_id_on_phonepe" => "NHT-" . Auth::id(),
                "phone_pe_merchant_id" => "M1VPZ8VOW6UH",
                "phone_pe_transaction_id" => strtoupper($this->generateUniqueTrstID(10)),
                "amount_in_paise" => $totalPrice * 100,
                "payment_status" => "PAYMENT INITIATED",
                "customer_id" => $inserted_id,
            ];

            $nhtOrder = NhtOrder::create($order_data);

            // ✅ Update customer order
            Srlorder::where("id", $inserted_id)->update([
                "nht_order_id" => $nhtOrder->id,
            ]);

            // ✅ PhonePe Configuration
            $client = StandardCheckoutClient::getInstance(
                "M1VPZ8VOW6UH_25120913183",
                1,
                "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0",
                Env::UAT
            );

            // ✅ Payment request
            $redirectUrl = route('retailer.checking_payment_status_srl', [
                'transaction_id' => encrypt($order_data["phone_pe_transaction_id"]),

            ]);

            $payRequest = StandardCheckoutPayRequestBuilder::builder()
                ->merchantOrderId($order_data["phone_pe_transaction_id"])
                ->amount($order_data["amount_in_paise"])
                ->redirectUrl($redirectUrl)
                ->message("Your order details")
                ->build();

            // ✅ Initiate Payment
            $payResponse = $client->pay($payRequest);

            if ($payResponse->getState() === "PENDING") {
                return redirect()->away($payResponse->getRedirectUrl());
            }

            return back()->with([
                "status" => "failure",
                "message" => "Payment initiation failed"
            ]);

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();

        } catch (\PhonePe\common\exceptions\PhonePeException $e) {

            return back()->with([
                "status" => "failure",
                "message" => $e->getMessage()
            ]);

        } catch (Exception $e) {

            dd($e->getMessage());

            return back()->with([
                "status" => "failure",
                "message" => $e->getMessage()
            ]);
        }
    }




    public function checking_payment_status_for_srl($transaction_id)
    {


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



        $statusCheckResponse = $client->getOrderStatus($merchantOrderId, true);

        if (isset($statusCheckResponse->state) && $statusCheckResponse->state === 'COMPLETED') {

            $transaction_data->update([
                "payment_status" => "PAYMENT SUCCESSFULL"
            ]);


            $user = Auth::user();
            $user_data = [
                'user_id' => $user->id,
                'user_name' => $user->firstname,
                'full_name' => $user->firstname . $user->lastname,
                'user_email' => $user->email,
                'user_mobile' => $user->mobile,
                'is_logged_in' => true,

            ];


            $row = Srlorder::where("nht_order_id", $transaction_data->id)->first();

            if (isset($row)) {
                $tokenString =
                    $this->key . '|' .
                    strtoupper($row->first_name . ' ' . $row->last_name) . '|' .
                    strtoupper($row->first_name) . '|SRL';

                $token = strtolower(hash('sha256', $tokenString));

                $token = "f0f38d3dfe850105ab9ccbf79db25d95bd6bfdad56fd98a45ebcd73cd022369e";
                $postData = [
                    "header" => [
                        "Token" => $token
                    ],
                    "body" => [
                        "FLAG" => "I",
                        "ORDERID" => "",
                        "HISORDERID" => "",
                        "ORDER_DT" => $row->booking_date,
                        "PTNT_CD" => "",
                        "HISCLIENTID" => "2",
                        "TITLE" => $row->title,
                        "FIRST_NAME" => $row->first_name,
                        "LAST_NAME" => $row->last_name,
                        "PTNTNM" => $row->first_name . ' ' . $row->last_name,
                        "DOB" => date("d-M-Y", strtotime($row->dob)),
                        "PTNT_GNDR" => $row->gender,
                        "DOB_ACT_FLG" => $row->dobFlag,
                        "MOBILE_NO" => $row->mobile,
                        "EMAIL_ID" => $row->email,
                        "ADDRESS" => $row->address,
                        "LOCATION" => $row->location,
                        "CITY" => $row->city,
                        "STATE" => $row->state,
                        "COUNTRY" => "India",
                        "ZIP" => $row->pincode,
                        "COLL_DATE_FROM" => date("d/m/Y h:i", strtotime($row->collection_date)),
                        "COLL_DATE_TO" => date("d/m/Y h:i", strtotime($row->collection_date . " +30 minutes")),
                        "TESTS" => "1302R",
                        "COLL_TYPE" => "H",
                        "ORDER_SOURCE" => "NH",
                        "CREATED_BY" => "C000145968"
                    ]
                ];

                // $url = 'https://apiprod.agilus.in/Order/OrderSendTestUpdate';

                $url = "https://apiuat.agilus.in/Order/OrderSendTestUpdate";

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url, $postData);


                $responseData = $response->json();

                dd($responseData);

                if (isset($responseData['RSP_CODE']) && $responseData['RSP_CODE'] == '100') {

                    $srl_order = Srlorder::where("nht_order_id", $transaction_data->id)->update([
                        'order_reference_no' => explode('|', $responseData['RSP_MSG'])[0],
                        'is_cancel_order' => 1
                    ]);


                    Srlcart::truncate();

                    return redirect()
                        ->route('retailer.invoice')
                        ->with('invoice_once', true);



                } else {

                    return redirect()->route('retailer.allpackages')
                        ->with(["status" => "failure", "message" => "Sometthing went Wrong"]);

                }


            }



        }



    }


    public function srlcartopen(Request $request)
    {

        $redcliffcartremove = Redcliffcart::where("package_id", $request->package_id)->delete();


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

            $srlcart = Srlcart::create([
                'package_id' => $package_id,
                'vendor_id' => $vendor_id,
                "user_id" => Auth::user()->id,
                "price" => $vendornhtprice->nht_price,
            ]);


            //this is correct
            $srlitems = Srlcart::all();


            return response()->json([
                'status' => 'success',
                "vendor" => "srl",
                'message' => 'Test added to the SRL cart',
                'package_id' => $package->id,
                'srlcartitems' => $srlitems,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function srlcartview()
    {


        $cartItems = Srlcart::get(['package_id', 'vendor_id']);
        $srlcart_items = Vendorpricenht::where(function ($query) use ($cartItems) {
            foreach ($cartItems as $item) {
                $query->orWhere(function ($q) use ($item) {
                    $q->where('package_id', $item->package_id)
                        ->where('vendor_id', $item->vendor_id);
                });
            }
        })->get();


        return view("retailer.srlcartview", compact('srlcart_items'));


    }
    public function individualpackage(Request $request)
    {

        try {

            $package_id = $request->id;
            $package = Newpackage::where("id", $package_id)->first();
            $vendordetails = Vendorpricenht::where("package_id", $package_id)->get();
            $recliffcartpackages_ids = Redcliffcart::pluck('package_id')->toArray();
            $redcliffcartitems = Redcliffcart::all();

            $srlpackage_ids = Srlcart::pluck("package_id")->toArray();
            $srlcartitems = Srlcart::all();


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


            return view("retailer.individualpackage", compact('package', 'data', 'recliffcartpackages_ids', 'redcliffcartitems', 'srlpackage_ids', 'srlcartitems'));


        } catch (Exception $e) {



        }

    }


    public function redcliffcart(Request $request)
    {
        try {

            $removesrlcart = Srlcart::where("package_id", $request->package_id)->delete();

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
                'vendor' => 'redcliff',
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


    //from here redcliff credentials
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


    }


    public function red_cliffe_order_placed(Request $request)
    {
        try {

            $package_ids = Redcliffcart::where("user_id", Auth()->user()->id)->pluck('package_id');

            // $exists = Customer_order::where('user_id', Auth::id())
            //     ->whereDate('booking_date', $request->booking_date)
            //     ->where("collection_date", $request->collection_date)
            //     ->where(function ($query) use ($package_ids) {
            //         foreach ($package_ids as $packageId) {
            //             $query->orWhereJsonContains('customer_packages', $packageId);
            //         }
            //     })
            //     ->exists();



            // if ($exists) {


            //     return redirect()->route('retailer.allpackages')

            //         ->with(["status" => "failure", "message" => "One or more selected packages are already booked for this date."]);

            // }


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
                $totalPrice = (int) Redcliffcart::where('user_id', Auth::id())->sum('price');
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


                $ordernht = NhtOrder::create($order_data);

                $nhtorderid = $ordernht->id;

                Customer_order::where("id", $inserted_id)->update([
                    "nht_order_id" => $nhtorderid,
                ]);


                $package_codes = Vendorpricenht::whereIn(
                    'package_id',
                    $order->customer_packages
                )
                    ->where('vendor_id', 1)
                    ->pluck('package_code')
                    ->toArray();
                $payload = [
                    "booking_date" => $order->booking_date,
                    "collection_date" => $order->collection_date,
                    "collection_slot" => $order->collection_slot_id,
                    "customer_address" => $order->customer_address,
                    "customer_age" => $order->customer_age,
                    "customer_altphonenumber" => $order->customer_whatsappnumber,
                    "customer_gender" => $order->customer_gender,
                    "customer_latitude" => $order->customer_latitude,
                    "customer_longitude" => $order->customer_longitude,
                    "customer_name" => $order->customer_name,
                    "customer_phonenumber" => $order->customer_phonenumber,
                    "customer_whatsapppnumber" => $order->customer_whatsappnumber,
                    "is_credit" => true,
                    "landmark" => $order->customer_landmark,
                    "package_code" => $package_codes,
                    "pincode" => $order->pincode,
                    "additional_member" => [],

                ];

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
                        ->with(["status" => "failure", "message" => $bookingResponseData["message"]]);
                }



                $booking_id = $bookingResponseData["booking_id"];
                // Log all API interactions
                $logs = [
                    "details_enter_api" => $payload,
                    "details_enter_api_response" => $bookingResponseData,
                    "confirmation_booking_api" => $booking_id
                ];

                $this->writeToLog($logs, 'bookings', 'redcliffe bookings');


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
                    [
                        'transaction_id' => encrypt($merchantOrderId),
                        'booking_id' => encrypt($booking_id),
                    ],

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


                // $this->lab_test_package_payment_for_redclif($inserted_id);

            } else {


            }
        } catch (Exception $e) {

            return back()->with(["status" => "failure", "message" => $e->getMessage()]);

        }

    }


    public function checking_payment_status_redcliffe($transaction_id, $booking_id)
    {
        // Decrypt transaction ID
        $transaction_id = decrypt($transaction_id);
        $booking_id = decrypt($booking_id);
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

            if (isset($statusCheckResponse->state) && $statusCheckResponse->state === 'COMPLETED') {

                $order = Customer_order::where("nht_order_id", $transaction_data->id)->first();

                // Update customer order with booking ID
                Customer_order::where("id", $order->id)->update([
                    "booking_id" => $booking_id,
                    "pk" => $booking_id,
                ]);

                $transaction_data->update([
                    "payment_status" => "PAYMENT SUCCESS"
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
                        ->with(["status" => $confirmResponseData["status"], "message" => $confirmResponseData["message"]]);
                }

                Redcliffcart::where('user_id', auth()->id())->delete();

                return redirect()
                    ->route('retailer.invoice', ['booking_id' => $booking_id])
                    ->with('invoice_once', true);




            }

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


    public function redcliff_retailer_orders(Request $request)
    {

        NhtOrder::pluck('user_id')->toArray();

        $redclliffallorders = Customer_order::where('user_id', Auth::id())
            ->where('collection_date', '>=', Carbon::now()->addHours(24))
            ->get();



        return view('retailer.redcliff_order', compact('redclliffallorders'));

    }

    public function wellness_page($id)
    {

        if ($id=="1") {

            /***************************** Self Checks API Integrations ***********************/

            // ✅ Static data + json_encode
            $self_checks_body = json_encode([
                "user_type" => "patient",
                "target_url" => "https://www.mfine.co/channel/zoom-gen-sc",
                "user_details" => [
                    "mobile_number" => "917754093527",
                    "firstname" => "Rohit",
                    "lastname" => "Singh",
                    "email" => "svksingh108@gmail.com",
                ]
            ]);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.mfine.co/api/v1/silent-login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,   // ✅ Fixed: was 0 (infinite hang)
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $self_checks_body,
                CURLOPT_HTTPHEADER => [
                    'client_id: zoom-gen-sc',
                    'secret_key: Y8NzQcDvm9HIfFqc3CjQGCOQaTOHrn3aDWPxNDZr4Tbk0OL0zKk0iOmACwRx8Nfk',
                    'Content-Type: application/json'
                ],
            ]);

            $response_self_checks = curl_exec($curl);
            curl_close($curl);

            // ✅ Fixed: added null check to avoid crash if API fails
            $self_checks_decoded = json_decode($response_self_checks);

            if (!$self_checks_decoded || !isset($self_checks_decoded->redirect_url)) {
                return back()->withErrors(['error' => 'Self Checks API failed: ' . $response_self_checks]);
            }

            $data['consultations'] = $self_checks_decoded->redirect_url;

            // ✅ API Log
            $self_checks_body_apilog = [
                'mfine_service' => 'self_checks',
                'request' => $self_checks_body,
                'response' => $response_self_checks
            ];

          

            // ✅ Fixed: added return so redirect actually executes
            return redirect($data['consultations']);

            /***************************** Self Checks API Integrations ***********************/
        }

        if ($id == 2) {

            /***************************** E-Pharmacy API Integrations ***********************/

            // ✅ Static data + proper variable name (avoid overwriting $data array)
            $epharmacy_payload = json_encode([
                "number" => "7754093527",   // ✅ Static number (no 91 prefix - 1mg uses plain number)
                "merchant_key" => "a46ed817-ecb5-4f8d-80d1-4d73ad37e044",
                "user_id" => "1",
                "source" => "novelhealthtech",
                "redirect_url" => "https://www.1mg.com"
            ]);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.1mg.com/api/v6/b2b/generate_hash',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,   // ✅ Fixed: was 0 (infinite hang)
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $epharmacy_payload,
                CURLOPT_HTTPHEADER => [
                    'X-Access-key: 1mg_client_access_key',
                    'Content-Type: application/json'
                ],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            // ✅ Fixed: added null check to avoid crash if API fails
            $response_data = json_decode($response);

            if (!$response_data) {
                return back()->withErrors(['error' => 'E-Pharmacy API failed. Invalid response.']);
            }

            // ✅ API Log (uncommented and cleaned up)
            $apilog = [
                'mfine_service' => 'e_pharmacy',
                'request' => $epharmacy_payload,
                'response' => $response
            ];


            if ($response_data->is_success == 1) {

                // ✅ Fixed: $data['employee']->mobile replaced with static number
                $data['consultations'] = 'https://www.1mg.com?merchant_token='
                    . $response_data->data->hash
                    . '&number=7754093527';

                // ✅ Fixed: added return so redirect actually executes
                return redirect($data['consultations']);

            } else {

                // ✅ Fixed: replaced CI3 session flash with Laravel session flash
                return back()->with('error', 'Something went wrong while generating E-Pharmacy link. Please try again later.');
            }

            /***************************** E-Pharmacy API Integrations ***********************/
        }



    }


}
