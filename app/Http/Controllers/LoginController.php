<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];


        if (Auth::attempt($credentials)) {

            $user = Auth::user();

    
            if ($user->hasRole('Super Admin')) {

                return redirect()->route("admindashboard");

            }

            if ($user->hasRole("retailer")) {


                return redirect()->route("retailer.retailerhomepage");
            }

           

            return redirect()->route("admindashboard");


        } else {
            return back()->with(["failure" => "Invalid Credentials"]);
        }



    }
}
