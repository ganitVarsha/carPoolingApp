<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller {

    private $accessError = [
        'status' => false,
        'error' => ['message' => 'Acces Token mismatch!'],
        'code' => '401',
        'message' => 'Acces Token mismatch!'
    ];

    /**
     * Create user
     *
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] phone number
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
     * Create user
     *
     * @param  [string] phone number
     * @return [string] message
     */
    public function signupViaPhone(Request $request) {
        $request->validate([
            'phone' => 'required|string|unique:users'
        ]);
        $user = new User;

        $user->phone = $request->phone;
        if ($user->save()) {
            return response()->json([
                        'status' => true,
                        'error' => [],
                        'code' => '200',
                        'message' => 'Successfully created user!'
                            ], 201);
        } else {
            return response()->json([
                        'status' => false,
                        'error' => ['message' => 'User with this email already exists!'],
                        'code' => '401',
                        'message' => 'User with this email already exists!'
                            ], 201);
        }
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
                        'error' => ['message' => 'Unauthorized'],
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
        $request->session()->push('accessTokens.' . $request->email, $tokenResult->accessToken);
        // to use this key, use : $request->session()->get('accessTokens'.$request->email)

        User::saveToken($request->email, $tokenResult->accessToken);
        return response()->json([
                    'status' => true,
                    'error' => [],
                    'code' => '200',
                    'data' => ['access_token' => $tokenResult->accessToken,
                        'otp' => $otp,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                                $tokenResult->token->expires_at
                        )->toDateTimeString()
                    ]
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
        $user = User::where('phone', $request->phone)->first();

        // Check Condition Mobile No. Found or Not
        if (empty($user) || $request->phone != $user->phone) {
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
        $request->session()->put('accessTokens.' . $request->phone, $accessToken);
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
        $request->session()->forget('accessTokens.' . $request->username);
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
        $request->session()->forget('accessTokens.' . $request->username);
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
                        'error' => ['message' => 'OTP mismatched'],
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

    /**
     * @param $length the length of the string to create
     * @author Varsha Mittal
     * @since 27-07-2018
     * @return [json] user object
     */
    public function getProfile(Request $request) {
        if (in_array($request->accessToken, $request->session()->get('accessTokens'))) {
            $data = User::getProfileData($request->accessToken);
            if (!empty($data)) {
                return response()->json([
                            'status' => true,
                            'error' => [],
                            'code' => '200',
                            'data' => $data
                ]);
            } else {
                return response()->json([
                            'status' => false,
                            'error' => ['message' => 'Profile data not found!'],
                            'code' => '401',
                            'message' => 'Profile data not found!'
                ]);
            }
        } else {
            return response()->json($this->accessError);
        }
    }

    /**
     * @param $request data received in API
     * @author Varsha Mittal
     * @since 27-07-2018
     * @return [json] user object
     */
    public function setProfile(Request $request) {
        if (in_array($request->accessToken, $request->session()->get('accessTokens'))) {
            $updateData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'email' => $request->email,
                'isd' => $request->isd,
                'phone' => $request->phone,
                'profession' => $request->profession,
                'nature' => $request->nature
            ];
            $data = User::setProfileData($request->accessToken, $updateData);
            if ($data) {
                return response()->json([
                            'status' => true,
                            'error' => [],
                            'code' => '200',
                            'data' => $data
                ]);
            } else {
                return response()->json([
                            'status' => false,
                            'error' => ['message' => 'Profile data not updated! Please try again!'],
                            'code' => '401',
                            'message' => 'Profile data not updated! Please try again!'
                ]);
            }
        } else {
            return response()->json($this->accessError);
        }
    }

}