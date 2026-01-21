<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Retailer\RetailerController;
use App\Http\Controllers\VendorController;
use App\Models\Srlcart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\CodeUnit\FunctionUnit;
use PhonePe\payments\v2\standardCheckout\StandardCheckoutClient;
use PhonePe\Env;
use PhonePe\payments\v2\models\request\builders\StandardCheckoutPayRequestBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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


Route::get("/contact_us",function(){
 
return view('website.contact_us');

})->name('contact_us');

Route::get("/privacy_policy",function(){
 
return view('website.privacy_policy');

})->name('privacy_policy');

Route::get("/CANCELLATION",function(){

return view('website.refund_and_cancellation');
})->name('refund_cancellation');

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


Route::middleware(['check.auth'])->group(function () {

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

       Route::get("/checking_payment_status_sr/{transaction_id}",[RetailerController::class, "checking_payment_status_for_srl"])->name('checking_payment_status_srl');


        //this is for the redcliff

        Route::post("/srlformsubmit", [RetailerController::class, "srlformsubmit"])->name("srlformsubmit");

        Route::post("/redcliffpincodesubmit", [RetailerController::class, "redcliffpincodesubmit"])->name('redcliffpincode.post');

        // Route::get("/srlcartview", function () {

        
        //     return view('retailer.srlcartview', compact('srlcartitems'));

        // })->name('srlcartview');

        Route::get("/srlcartview",[RetailerController::class,"srlcartview"])->name('srlcartview');



    

        Route::get("/payment_cheking", [RetailerController::class, "checking_payment_status_for_srl"])->name('checking_payment_status_for_srl');

        //this is for the redcliff

        Route::post("/redcliffcart", [RetailerController::class, "redcliffcart"])->name('redcliffcart');

        Route::get("/redcliffcartview", [RetailerController::class, "redcliffcartview"])->name('redcliffcartview');

        Route::post("/redcliffdate", [RetailerController::class, "redcliffdates"])->name("redcliffdate.post");

        Route::post("/redclifftimeslotsubmit", [RetailerController::class, "redclifftimeslotsubmit"])->name('redclifftimeslotsubmit');

        Route::get("/redcliffbookingdetail", [RetailerController::class, "redcliffbookingdetailview"])->name('redcliffbookingdetailview');

        Route::post("/red_cliffe_order_placed", [RetailerController::class, "red_cliffe_order_placed"])->name('red_cliffe_order_placed');

        //this is for the payment
        Route::get("/checking_payment_status_redcliffe/{transaction_id}/{booking_id}", [RetailerController::class, "checking_payment_status_redcliffe"])->name("checking_payment_status_redcliffe");

        Route::get("/Payment_and_finalbooking_controller", [RetailerController::class, "Payment_and_finalbooking_controller"])->name('Payment_and_finalbooking_controller');

        Route::get("/invoice_generation", [InvoiceController::class, "generate"])->name('invoice');
        Route::get("/redcliff_orders",[RetailerController::class, "redcliff_retailer_orders"])->name('redcliff.orders');
    });



});


Route::get("/invoice", function () {


    

    return view('retailer.invoice');

    
});

Route::get("/getlogs", function () {


    $logs = [
        "details_enter_api" => "fsdfds",
        "details_enter_api_response" => "fsdfsdf",
        "confirmation_booking_api" => "fsdfsd",
        "confirmation_booking_api_response" => "fsdfsdfsdf",
    ];

    // Folder & file
    $directory = 'redlicfff';
    $fileName = date('Y-m-d') . '.log';
    $filePath = $directory . '/' . $fileName;

    // Ensure directory exists
    if (!Storage::disk('public')->exists($directory)) {
        Storage::disk('public')->makeDirectory($directory);
    }

    // Prepare log content
    $logContent = "\n---------------- START ----------------\n";
    $logContent .= "Date: " . now()->format('Y-m-d H:i:s') . "\n";
    $logContent .= print_r($logs, true);
    $logContent .= "\n---------------- END ------------------\n";

    // Write log
    Storage::disk('public')->append($filePath, $logContent);

    echo "sdfsdfdsf";

});

Route::get('/phonepe-test', function () {

    try {

        $totalPrice = 1; // ₹1 test

        // 1️⃣ Order data (NO DB)
        $order_data = [
            "user_id" => "1",
            "user_id_on_phonepe" => "NHT-1",
            "phone_pe_merchant_id" => "M1VPZ8VOW6UH",
            "phone_pe_transaction_id" => "TEST" . strtoupper(Str::random(10)), // ✅ Generate unique ID
            "amount_in_paise" => $totalPrice * 100,
            "payment_status" => "PAYMENT INITIATED",
            "customer_id" => 123,
        ];

        // 2️⃣ PhonePe Client
        $env = Env::UAT;

        $client = StandardCheckoutClient::getInstance(
            "M1VPZ8VOW6UH_25120913183",
            1,
            "NGQxNzhmZWMtY2NkZS00YjkyLThhNDEtY2VmNTE2YWRiMTQ0",
            $env
        );

        // 3️⃣ Payment Request
        $merchantOrderId = $order_data['phone_pe_transaction_id'];

        $redirectUrl = route(
            'phonepe-test-callback',
            ['transaction_id' => encrypt($merchantOrderId)]
        );

        $payRequest = StandardCheckoutPayRequestBuilder::builder()
            ->merchantOrderId($merchantOrderId)
            ->amount($order_data['amount_in_paise'])
            ->redirectUrl($redirectUrl)
            ->message("Test Payment")
            ->build();

        // 4️⃣ Call PhonePe
        $payResponse = $client->pay($payRequest);

        if ($payResponse->getState() === "PENDING") {
            return redirect()->away($payResponse->getRedirectUrl());
        }

        return "Payment initiation failed: " . $payResponse->getState();

    } catch (\Exception $e) {
        dd($e->getMessage());
    }
});


Route::get('/phonepe-test-callback/{transaction_id}', function ($transaction_id) {

    dd([
        "message" => "PhonePe Callback Hit",
        "transaction_id" => decrypt($transaction_id),
        "time" => now()->toDateTimeString()
    ]);

})->name('phonepe-test-callback');