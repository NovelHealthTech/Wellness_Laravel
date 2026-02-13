<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


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


            if ($user->roles == 1) {

                return redirect()->route("admindashboard");

            }

            if ($user->roles == 2 && $user->is_loggedin==1) {

                    
                return redirect()->route("retailer.retailerhomepage");
            }



            return redirect()->route("admindashboard");


        } else {
            return back()->with(["failure" => "Invalid Credentials"]);
        }



    }

    public function signupview(Request $request)
    {

        return view('register');

    }
    public function signup(Request $request)
    {

        try {

            $validated = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'password' => 'required|min:6|confirmed',
                'dob' => 'required|date',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'pincode' => 'required|digits:6',
                "gender" => "required",
            ]);

            $validated["is_loggedin"] = 0;
            $validated["role_id"] = 2;
            $otp = rand(1000, 9999);

            $validated['otp'] = $otp;


            $user = User::create($validated);

            if ($user) {

                $response = Http::get('https://sms.staticking.com/index.php/smsapi/httpapi/', [
                    'secret' => 'hlEqvyj5G1fprh1ZnMyv',
                    'sender' => 'NOVLHT',
                    'tempid' => '1707169762712317207',
                    'receiver' => $request->mobile,
                    'route' => 'TA',
                    'msgtype' => '1',
                    'sms' => 'The OTP to verify your mobile number for Novel Healthtech is ' .
                        $otp .
                        '. Do not share this OTP with anyone for security reasons. Valid for 15 minutes.'
                ]);

                if ($response->status() == 200) {

                    $number = $request->mobile;
                    $email = $request->email;

                    return view("vetifyotpview", compact("number", "email"));

                }

            }

        } catch (Exception $e) {

            return back()->with(["status" => "failure", "message" => "Something went wrong pls try again...!!!"]);

        }

    }

    public function verifyotp(Request $request)
    {

        try {

            $number = $request->number;
            $email = $request->email;

            $user = User::where("mobile", $number)->where("email", $email)->first();
            $userotp = User::where("mobile", $number)->where("email", $email)->value('otp');
            $otp = implode('', $request->otp);




            if ($userotp == $otp) {
                $user->update([
                    "is_loggedin" => 1,
                ]);

                request()->session()->invalidate();

                // Regenerate CSRF token
                request()->session()->regenerateToken();

                // Log the user in
                Auth::login($user);

                // Redirect with cache prevention headers
                return redirect()->route('retailer.allpackages')->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                ]);

            } else {


                return back()->with(["status" => "failire", "message" => "otp did not match"]);
            }


        } catch (Exception $e) {


            return back()->with(["status" => "failure", "message" => "Something went wrong please try again....!!!!"]);



        }


    }

    public function signout(Request $request)
    {



        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('loginview');
    }
}
