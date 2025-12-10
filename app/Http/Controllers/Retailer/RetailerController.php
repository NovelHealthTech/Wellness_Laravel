<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Models\Newpackage;
use App\Models\Srlorder;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <-- Import this
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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


            $vendors = Vendor::all();

            return view('retailer.allpackages', compact('allpackages', 'vendors'));

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


            return response()->json([
                'pincode' => $pincode,
                'api_response' => $response->json()
            ]);

        } catch (Exception $e) {
            return response()->json([

                "error" => $e->getMessage(),
            ]);


        }
    }




    public function srldatesubmit(Request $request)
    {
        try {
            $date = date("d-M-Y", strtotime($request->input('date')));
            $pincode = $request->input('pincode');

            $payload = [
                "header" => [
                    "Token" => strtolower(hash('sha256', env('API_KEY') . '|' . strtoupper($pincode) . '|SRL'))
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
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
            ]);

            // Execute cURL request
            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                return response()->json(['error' => curl_error($curl)], 500);
            }

            curl_close($curl);

            // Decode the JSON response
            $responseData = json_decode($response, true);

            // Return only the API response
            return response()->json($responseData);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "failure",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function srlslotsubmitdata(Request $request)
    {

        return redirect()->route('retailer.srlinfo_form')->with(["timing" => $request->selected_slot, "pincode" => $request->selected_pincode, "package_id" => $request->selected_package]);


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

            dd($e->errors());


            return back()->withErrors($e->errors())->withInput();


        } catch (Exception $e) {

            dd($e->getMessage());

            return back()->with(["error" => $e->getMessage()]);

        }


    }

    public function lab_test_package_payment($order_id, $package_id)
    {
        $user = Auth::user();

        $package = Newpackage::findorFail($package_id);



        $order_data = [
            'user_id' => $user->id, // Laravel uses 'id' by default
            'user_id_on_phonepe' => 'NHT-' . $user->id,
            'phone_pe_merchant_id' => 'M1VPZ8VOW6UH',
            'phone_pe_transaction_id' => strtoupper(Str::random(6)), // generates 6-char unique ID
            'service_name' => $package->name,
            'payment_status' => 'PAYMENT INITIATED',
            'amount_in_paise' => $package->price * 100,
        ];


        $request = [
            "merchantId" => "M1VPZ8VOW6UH",
            "merchantTransactionId" => $order_data["phone_pe_transaction_id"],
            "merchantUserId" => $order_data["user_id_on_phonepe"],
            "amount" => $order_data["amount_in_paise"],
            "redirectUrl" => route('payment.checking', [
                'transaction' => urlencode($order_data['phone_pe_transaction_id'])
            ]),
            "redirectMode" => "POST",
            "callbackUrl" => route('payment.verification'),
            "mobileNumber" => $user->mobile,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        // 2️⃣ Convert array to JSON and base64 encode
        $requestJson = json_encode($request);
        $base64EncodedPayload = base64_encode($requestJson);

        // 3️⃣ Salt key and index
        $saltKey = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
        $saltIndex = '2';

        // 4️⃣ Generate the final hash for X-VERIFY
        $finalValue = hash('sha256', $base64EncodedPayload . '/pg/v1/pay' . $saltKey) . '###' . $saltIndex;

        // 5️⃣ Send POST request using Laravel HTTP client
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $finalValue,
            'Accept' => 'application/json'
        ])->post('https://api.phonepe.com/apis/hermes/pg/v1/pay', [
                    'request' => $base64EncodedPayload
                ]);



        if ($response->successful()) {

            // // Insert data into nht_orders table
            // $nhtOrder = DB::table('nht_orders')->insertGetId($order_data);

            // // Or using Eloquent model (recommended)
            // // $nhtOrder = NhtOrder::create($order_data);
            // // $nhtOrderId = $nhtOrder->id;

            // // Update srl_orders table
            // DB::table('srl_orders')
            //     ->where('id', $inserted_id)
            //     ->update([
            //         'nht_order_id' => $nhtOrder,
            //         'package_id' => $package_id,
            //         // Add more columns and values as needed
            //     ]);

            // Check if response has the redirect URL
            if (isset($response->json()['data']['instrumentResponse']['redirectInfo']['url'])) {
                $redirectUrl = $response->json()['data']['instrumentResponse']['redirectInfo']['url'];
                return redirect()->away($redirectUrl);
                
            } else {
                    
                return back()->with('error', 'Something Went Wrong! Kindly Try Again.');

            }

        } else {
            return back()->with('error', 'Payment initiation failed. Please try again.');
        }
    }




}
