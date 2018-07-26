<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller {

    /**
     * Create user
     *
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request) {
        $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'message' => 'Successfully created user!'
                        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                        'status' => false,
                        'error' => [],
                        'code' => '401',
                        'message' => 'Unauthorized'
                            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $otp = rand(1000, 9999);
        $request->session()->put($request->email, $tokenResult->accessToken);
        // to use this key, use : $request->session()->get($request->email)

        User::saveToken($request->email, $tokenResult->accessToken);
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'access_token' => $tokenResult->accessToken,
                    'otp' => $otp,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                    )->toDateTimeString()
        ]);
    }

    /**
     * Login with phone number
     * @params [string] phone number
     * @return [array] data returns
     * @author Varsha
     * @since 26-07-2018
     */
    public function mobileLogin(Request $request) {
//        $request->user()->token()->revoke();
        // Get user record
        $user = User::where('phone', $request->get('phone'))->first();

        // Check Condition Mobile No. Found or Not
        if ($request->get('phone') != $user->phone) {
            \Session::put('errors', 'Your mobile number not match in our system..!!');
            return response()->json([
                        'status' => false,
                        'error' => [
                            'message' => 'Mobile number not found in our system.'
                        ],
                        'code' => '401',
            ]);
        }

        // Set Auth Details
        \Auth::login($user);
        $otp = rand(1000, 9999);
        $accessToken = $this->randomString();
        $request->session()->put($request->phone, $accessToken);
        $request->session()->put($request->phone . "_otp", $otp);

        User::saveToken($request->phone, $accessToken);
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'access_token' => $accessToken,
                    'otp' => $otp,
                    'message' => 'OTP created'
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
//        User::removeToken($request->username, $request->accessToken);
        $request->session()->forget($request->username);
        $request->session()->forget($request->username . "_otp");
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'message' => 'Successfully logged out'
        ]);
    }
    
    
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function mobileLogout(Request $request) {
//        $request->user()->token()->revoke();
        User::removeToken($request->username, $request->accessToken);
        $request->session()->forget($request->username);
        $request->session()->forget($request->username . "_otp");
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Confirm OTP
     *
     * @return [boolean] OTP matched or not
     */
    public function matchOTP(Request $request) {
//        $request->user()->token()->revoke();
        if ($request->session()->get($request->phone . "_otp") == $request->otp) {
            return response()->json([
                        'status' => true,
                        'error' => [],
                        'code' => '200',
                        'message' => 'OTP matched'
            ]);
        } else {
            return response()->json([
                        'status' => false,
                        'error' => [],
                        'code' => '401',
                        'message' => 'OTP mismatched'
            ]);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request) {
        return response()->json($request->user());
    }

    /*
     * Create a random string
     * @param $length the length of the string to create
     * @return $str the string
     */

    private function randomString($length = 16) {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}
