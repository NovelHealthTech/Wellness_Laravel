<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Retailer\RetailerController;
use App\Http\Controllers\VendorController;
use App\Models\Srlcart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\CodeUnit\FunctionUnit;

Route::get('/', function () {

    return view('website.index');


})->name("home");


Route::get("/services", function () {

    return view('website/services');

})->name('services');

Route::get("/about", function () {

    return view('website.about');

})->name('about');

Route::get("/blogs", function () {

    return view('website.blogs');

})->name('blog');



Route::get("/loginview", function () {
    return response()
        ->view('login')
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->name('loginview');
Route::post("/login", [LoginController::class, "login"])->name('login.post');
Route::get("/signupview", [LoginController::class, "signupview"])->name("signupview");
Route::post("/signup", [LoginController::class, "signup"])->name('signup');


Route::get("/otpview", function () {

    return view('vetifyotpview');

});

Route::post("/verifyotp", [LoginController::class, "verifyotp"])->name('verifyotp');

Route::get("/admindashboard", function () {

    return view('admin.admindashboard');

})->name('admindashboard');

Route::get("/signout", [LoginController::class, "signout"])->name('signout');


Route::name('admin.')->group(function () {

    Route::resource("role", RoleController::class);
    Route::get("/fetchrolesdata", [RoleController::class, "fetchroles"])->name('role.fetchroles');
    Route::resource("package", PackageController::class);
    Route::get("/fetchpackages", [PackageController::class, "fetchallpackages"])->name('package.fetchpackages');
    Route::resource("vendor", VendorController::class);
    Route::get("/fetchroles", [VendorController::class, "fetchvendor"])->name('vendor.fetchvendor');
    Route::resource("coupon", CouponController::class);
    Route::get("/fetchcoupons", [CouponController::class, "fetchcoupons"])->name('coupon.fetchcoupons');

});


Route::name("retailer.")->group(function () {

    Route::get('/select-location/{eloc}', [RetailerController::class, 'getLocationDetails'])->name('location');

    Route::get("/retailer", [RetailerController::class, "retailerhomepage"])->name('retailerhomepage');

    Route::get("/individualpackage/{id}", [RetailerController::class, "individualpackage"])->name('individual_package');

    Route::get("/allpackages", [RetailerController::class, "allpackages"])->name('allpackages');

    //routes for the srl
    Route::post("/srlcartopen", [RetailerController::class, "srlcartopen"])->name('srl_cart');
    Route::get("/pincodesubmit", [RetailerController::class, "srlpincodesubmit"])->name('srlpincode.post');


    Route::post("/datesubmit", [RetailerController::class, "srldatesubmit"])->name('srldate.post');
    Route::post("/slotsubmit", [RetailerController::class, "srlslotsubmitdata"])->name('srlslotsubmit.post');
    Route::get("/srlinfo_form", function () {
        return view('retailer.srlinfo_form');
    })->name('srlinfo_form');

    Route::post("/srlformsubmit", [RetailerController::class, "srlformsubmit"])->name("srlformsubmit");

    Route::post("/redcliffpincodesubmit", [RetailerController::class, "redcliffpincodesubmit"])->name('redcliffpincode.post');

    Route::get("/srlcartview", function () {

        $srlcartitems = Srlcart::all();
        return view('retailer.srlcartview', compact('srlcartitems'));

    })->name('srlcartview');

    Route::get("/payment_cheking", [RetailerController::class, "checking_payment_status_for_srl"])->name('checking_payment_status_for_srl');

    //this is for the redcliff


    Route::post("/redcliffcart", [RetailerController::class, "redcliffcart"])->name('redcliffcart');

    Route::get("/redcliffcartview", [RetailerController::class, "redcliffcartview"])->name('redcliffcartview');

    Route::post("/redcliffdate", [RetailerController::class, "redcliffdates"])->name("redcliffdate.post");

    Route::post("/redclifftimeslotsubmit", [RetailerController::class, "redclifftimeslotsubmit"])->name('redclifftimeslotsubmit');

    Route::get("/redcliffbookingdetail", [RetailerController::class, "redcliffbookingdetailview"])->name('redcliffbookingdetailview');

    Route::post("/red_cliffe_order_placed", [RetailerController::class, "red_cliffe_order_placed"])->name('red_cliffe_order_placed');

    //this is for the payment
    Route::get("/checking_payment_status_redcliffe/{transaction_id}", [RetailerController::class, "checking_payment_status_redcliffe"])->name("checking_payment_status_redcliffe");

    Route::get("/Payment_and_finalbooking_controller", [RetailerController::class, "Payment_and_finalbooking_controller"])->name('Payment_and_finalbooking_controller');

    Route::get("/invoice_generation", [RetailerController::class, "invoice_generation"])->name('invoice');
});



Route::name("redcliff.")->group(
    function () {
        Route::post("/redcliffpincodesubmit", [RetailerController::class, "redcliffpincodesubmit"])->name('redcliffpincode.post');

    }
);

Route::get("/srl", function ($orderid, $package_id) {

    $user = (object) [
        'id' => 999999, // Dummy user ID
        'mobile' => '9999999999' // Dummy mobile
    ];

    // OR use real user but with dummy transaction
    // $user = Auth::user();

    // Create dummy package data
    $package = (object) [
        'id' => $package_id ?? 1,
        'name' => 'Test Lab Package',
        'price' => 1 * 100 // ₹1 for testing
    ];

    // Dummy order data
    $order_data = [
        'user_id' => 999999, // Dummy user ID
        'user_id_on_phonepe' => 'NHT-DUMMY-' . rand(1000, 9999),
        'phone_pe_merchant_id' => 'M1VPZ8VOW6UH', // ✅ Real production merchant
        'phone_pe_transaction_id' => 'DUMMY' . time() . strtoupper(Str::random(6)),
        'service_name' => 'Test Package - DO NOT PROCESS',
        'payment_status' => 'PAYMENT INITIATED',
        'amount_in_paise' => 100, // ₹1 only for testing
    ];

    $request = [
        "merchantId" => "M1VPZ8VOW6UH", // ✅ Real production merchant
        "merchantTransactionId" => $order_data["phone_pe_transaction_id"],
        "merchantUserId" => $order_data["user_id_on_phonepe"],
        "amount" => 100, // ✅ Small amount (₹1)
        "redirectUrl" => route('payment.checking', [
            'transaction' => $order_data['phone_pe_transaction_id']
        ]),
        "redirectMode" => "POST",
        "callbackUrl" => route('payment.verification'),
        "mobileNumber" => "9999999999", // ✅ Dummy mobile
        "paymentInstrument" => [
            "type" => "PAY_PAGE"
        ]
    ];

    $requestJson = json_encode($request);
    $base64EncodedPayload = base64_encode($requestJson);

    // ✅ Real production credentials
    $saltKey = 'c42a3914-25d2-4c3f-808b-bc9c4cae5530';
    $saltIndex = '2';

    $finalValue = hash('sha256', $base64EncodedPayload . '/pg/v1/pay' . $saltKey) . '###' . $saltIndex;

    // ✅ Real production API
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'X-VERIFY' => $finalValue,
        'Accept' => 'application/json'
    ])->post('https://api.phonepe.com/apis/hermes/pg/v1/pay', [
                'request' => $base64EncodedPayload
            ]);

    $responseData = $response->json();

    // Log the response for debugging
    \Log::info('PhonePe Response:', $responseData);

    if ($response->successful() && isset($responseData['success']) && $responseData['success'] === true) {

        // ⚠️ Optional: Save dummy order (or skip this)
        // $nhtOrder = DB::table('nht_orders')->insertGetId($order_data);

        $redirectUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'] ?? null;

        if ($redirectUrl) {
            // ✅ This will open the PhonePe payment page
            return redirect()->away($redirectUrl);
        } else {
            return back()->with('error', 'Payment URL not found.');
        }

    } else {
        \Log::error('PhonePe Error:', [
            'response' => $responseData,
            'status' => $response->status()
        ]);
        return back()->with('error', 'Payment initiation failed: ' . ($responseData['message'] ?? 'Unknown error'));
    }

});

Route::get("paymentverfication", function () {

    dd("Sfdsdfdsf");


})->name("payment.verification");




// Route::get("/srl", function () {

//     // Get token
//     $tokenResponse = Http::asForm()->post(
//         'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token',
//         [
//             "client_version" => 1,
//             "grant_type" => "client_credentials",
//             "client_id" => "M1VPZ8VOW6UH_25120913183",
//             "client_secret" => "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0"
//         ]
//     );

//     $tokenData = $tokenResponse->json();
//     $accessToken = $tokenData['access_token'];

//     // Try with O-Bearer prefix (since token_type was "O-Bearer")
//     $paymentResponse = Http::withHeaders([
//         "Content-Type" => "application/json",
//         "Authorization" => "O-Bearer " . $accessToken  // Add O-Bearer prefix
//     ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay', [
//                 "merchantOrderId" => "TX" . time(),
//                 "amount" => 1000,
//                 "expireAfter" => 1200,
//                 "metaInfo" => [
//                     "udf1" => "additional-information-1",
//                     "udf2" => "additional-information-2",
//                     "udf3" => "additional-information-3",
//                     "udf4" => "additional-information-4",
//                     "udf5" => "additional-information-5",
//                     "udf6" => "additional-information-6",
//                     "udf7" => "additional-information-7",
//                     "udf8" => "additional-information-8",
//                     "udf9" => "additional-information-9",
//                     "udf10" => "additional-information-10",
//                     "udf11" => "additional-information-11",
//                     "udf12" => "additional-information-12",
//                     "udf13" => "additional-information-13",
//                     "udf14" => "additional-information-14",
//                     "udf15" => "additional-information-15"
//                 ],
//                 "paymentFlow" => [
//                     "type" => "PG_CHECKOUT",
//                     "message" => "Payment message used for collect requests",
//                     "merchantUrls" => [
//                         "redirectUrl" => route("payment.callback")
//                     ]
//                 ]
//             ]);

//     $data = [
//         'status' => $paymentResponse->status(),
//         'response' => $paymentResponse->json(),
//         'token_used' => $accessToken,
//         'callback_url' => route("payment.callback")
//     ];


//     return  redirect()->route('payment')->with(["data"=>$data]);

//     // // Debug output
//     // return response()->json([
//     //     'status' => $paymentResponse->status(),
//     //     'response' => $paymentResponse->json(),
//     //     'token_used' => $accessToken,
//     //     'callback_url' => route("payment.callback")
//     // ]);


// });

// Route::get("/callback", function () {
//     return "Payment callback received";
// })->name("payment.callback");



// route::get("/payment",function(){

// return view('payment');

// })->name('payment');