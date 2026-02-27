<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/Servicable_status", function (Request $request) {

    $key = "4DEF92694DC6B2D0CD5635BBB1781916";
    $pincode = $request->pincode;
    $source = "HK";

    // Generate Token
    $data = $key . "|" . $pincode . "|AGILUS";
    $token = hash('sha256', $data);

    // Call Agilus API
    $response = Http::withOptions(['verify' => false])
        ->post("https://apiuat.agilus.in/api/IntegrationAPI/GetServiceableStatus", [
            "header" => [
                "Token" => $token
            ],
            "body" => [
                "Pincode" => $pincode,
                "Source" => $source
            ]
        ]);

    return response()->json($response->json());
});
Route::post("/gettimeeslots", function (Request $request) {

   


});