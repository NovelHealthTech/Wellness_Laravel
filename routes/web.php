<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Retailer\RetailerController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


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

Route::get("/login", function () {

    return view('login');

});

Route::get("/loginview", function () {

    return view('login');

})->name('loginview');

Route::get("/admindashboard", function () {

    return view('admin.admindashboard');

})->name('admindashboard');

Route::post("/login", [LoginController::class, "login"])->name('login.post');

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

    Route::get("/retailer", [RetailerController::class, "retailerhomepage"])->name('retailerhomepage');

    Route::get("/allpackages", [RetailerController::class, "allpackages"])->name('allpackages');



    //routes for the srl
    Route::post("/pincodesubmit", [RetailerController::class, "srlpincodesubmit"])->name('srlpincode.post');
    Route::post("/datesubmit", [RetailerController::class, "srldatesubmit"])->name('srldate.post');
    Route::post("/slotsubmit", [RetailerController::class, "srlslotsubmitdata"])->name('srlslotsubmit.post');
    Route::get("/srlinfo_form", function () {
        return view('retailer.srlinfo_form');
    })->name('srlinfo_form');

    Route::post("/srlformsubmit",[RetailerController::class,"srlformsubmit"])->name("srlformsubmit");

});

Route::get("/srl", function () {

    // Get token
    $tokenResponse = Http::asForm()->post(
        'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token',
        [
            "client_version" => 1,
            "grant_type" => "client_credentials",
            "client_id" => "M1VPZ8VOW6UH_25120913183",
            "client_secret" => "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0"
        ]
    );

    $tokenData = $tokenResponse->json();
    $accessToken = $tokenData['access_token'];

    // Try with O-Bearer prefix (since token_type was "O-Bearer")
    $paymentResponse = Http::withHeaders([
        "Content-Type" => "application/json",
        "Authorization" => "O-Bearer " . $accessToken  // Add O-Bearer prefix
    ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay', [
                "merchantOrderId" => "TX" . time(),
                "amount" => 1000,
                "expireAfter" => 1200,
                "metaInfo" => [
                    "udf1" => "additional-information-1",
                    "udf2" => "additional-information-2",
                    "udf3" => "additional-information-3",
                    "udf4" => "additional-information-4",
                    "udf5" => "additional-information-5",
                    "udf6" => "additional-information-6",
                    "udf7" => "additional-information-7",
                    "udf8" => "additional-information-8",
                    "udf9" => "additional-information-9",
                    "udf10" => "additional-information-10",
                    "udf11" => "additional-information-11",
                    "udf12" => "additional-information-12",
                    "udf13" => "additional-information-13",
                    "udf14" => "additional-information-14",
                    "udf15" => "additional-information-15"
                ],
                "paymentFlow" => [
                    "type" => "PG_CHECKOUT",
                    "message" => "Payment message used for collect requests",
                    "merchantUrls" => [
                        "redirectUrl" => route("payment.callback")
                    ]
                ]
            ]);

    $data = [
        'status' => $paymentResponse->status(),
        'response' => $paymentResponse->json(),
        'token_used' => $accessToken,
        'callback_url' => route("payment.callback")
    ];


    return  redirect()->route('payment')->with(["data"=>$data]);

    // // Debug output
    // return response()->json([
    //     'status' => $paymentResponse->status(),
    //     'response' => $paymentResponse->json(),
    //     'token_used' => $accessToken,
    //     'callback_url' => route("payment.callback")
    // ]);


});

Route::get("/callback", function () {
    return "Payment callback received";
})->name("payment.callback");



route::get("/payment",function(){

return view('payment');

})->name('payment');