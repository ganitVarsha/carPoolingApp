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
     * Create Response
     * @params [boolean] $status true or false
     * @params [string] $message custome message to request
     * @params [int] $error_code error code against request
     * @params [array] $data data to be sent to user
     * @return [array] response array
     * @author Varsha
     * @since 30-07-2018
     */
    private function generateResponse($status = false, $message = 'Request failed.', $error_code = 500, $data = []) {
        $response = [
            'status' => $status,
            'message' => $message,
            'error_code' => $error_code,
        ];

        if (!empty($data))
            $response['data'] = $data;

        return $response;
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
     * Create user via Passport authentication
     *
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] phone number
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     * @author Varsha
     * @since 30-07-2018
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
     * Login user and create token using passport 
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     * @author Varsha
     * @since 30-07-2018
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

    //for mobile on the basis of phone number

    /**
     * Create token with phone number
     * 
     * @params [string] phone number
     * @return [array] data returns
     * @author Varsha
     * @since 30-07-2018
     */
    public function createToken(Request $request) {
        // Get user record
        $user = User::where('phone', $request->phone)->first();

        // Check Condition Mobile No. Found or Not
        if (empty($user) || $request->phone != $user->phone) {
            return response()->json($this->generateResponse(false, 'Mobile number not found in our system.', 401));
        }

        $accessToken = $this->randomString();
        $request->session()->put('accessTokens.' . $request->phone, $accessToken);

        User::saveToken($request->phone, $accessToken);
        return response()->json($this->generateResponse(true, 'Access Token created successfully!', 200, ['access_token' => $accessToken]));
    }

    /**
     * Create user
     *
     * @param  [string] phone number
     * @return [string] message
     * @author Varsha
     * @since 30-07-2018
     */
    public function signupViaPhone(Request $request) {
        $request->validate([
            'phone' => 'required|string|unique:users'
        ]);
        $user = new User;

        $user->phone = $request->phone;
        $user->app_user_id = 'sp_' . $this->randomString(10);
        if ($user->save()) {
            return response()->json($this->generateResponse(true, 'Successfully created user!', 200));
        } else {
            return response()->json($this->generateResponse(false, 'User with this phone number already exists!', 401));
        }
    }

    /**
     * Login with phone number
     * 
     * @params [string] phone number
     * @return [array] data returns
     * @author Varsha
     * @since 26-07-2018
     */
    public function mobileLogin(Request $request) {
        // Get user record
        $user = User::where('phone', $request->phone)->first();

        // Check Condition Mobile No. Found or Not
        if (empty($user) || $request->phone != $user->phone) {
            return response()->json($this->generateResponse(false, 'Mobile number not found in our system.', 401));
        }

        // Set Auth Details
        \Auth::login($user);
        $otp = rand(1000, 9999);
        $request->session()->put($request->phone . "_otp", $otp);

        return response()->json($this->generateResponse(true, 'Logged in successfully. Please enter OTP', 200, ['otp' => $otp, 'user_id' => $user->app_user_id]));
    }

    /**
     * Confirm OTP
     *
     * @param  [string] phone phone number
     * @return [int] otp otp sent during login
     * @return [boolean] OTP matched or not
     * @author Varsha
     * @since 26-07-2018
     */
    public function matchOTP(Request $request) {
        if ($request->session()->get($request->phone . "_otp") == $request->otp) {
            return response()->json($this->generateResponse(true, 'OTP Matched!', 200));
        } else {
            return response()->json($this->generateResponse(false, 'OTP Mismatch!', 401));
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param  [string] phone phone number
     * @return [string] message
     * @author Varsha
     * @since 30-07-2018
     */
    public function mobileLogout(Request $request) {
        $request->session()->forget('accessTokens.' . $request->username);
        $request->session()->forget($request->username . "_otp");
        return response()->json($this->generateResponse(true, 'Successfully logged out the user!', 200));
    }

    //to be updated from here.....

    /**
     * @param $length the length of the string to create
     * @author Varsha Mittal
     * @since 27-07-2018
     * @return [json] user object
     */
    public function getProfile(Request $request) {
        $data = User::getProfileData($request->app_user_id);
        if (!empty($data)) {
            return response()->json($this->generateResponse(true, 'User Exists!', 200, $data));
        } else {
            return response()->json($this->generateResponse(false, 'User not found!', 401));
        }
    }

    /**
     * @param $request data received in API
     * @author Varsha Mittal
     * @since 27-07-2018
     * @return [json] user object
     */
    public function setProfile(Request $request) {
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
        $data = User::setProfileData($request->app_user_id, $updateData);
        if ($data) {
            return response()->json($this->generateResponse(true, 'Profile updated successfully!', 200));
        } else {
            return response()->json($this->generateResponse(false, 'Profile data not updated! Please try again with valid data!', 401));
        }
    }

}
