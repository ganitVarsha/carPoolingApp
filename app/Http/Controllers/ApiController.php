<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Pool;

class ApiController extends Controller {

    private $accessError = [
        'status' => false,
        'error' => ['message' => 'Acces Token mismatch!'],
        'code' => '401',
        'message' => 'Acces Token mismatch!'
    ];

    /**
     * @param $request data received in API
     * @author Varsha Mittal
     * @since 30-07-2018
     * @return [json] user object
     */
    public function setPool(Request $request) {
        if (in_array($request->accessToken, $request->session()->get('accessTokens'))) {
            $user_id = User::getUserIdOnToken($token);
            $pool = new Pool();
            $pool->user_id = $user_id[0]->id;
            $pool->start_location = $request->start_location;
            $pool->start_longitude = $request->start_longitude;
            $pool->start_lattitude = $request->start_lattitude;
            $pool->end_location = $request->end_location;
            $pool->end_longitude = $request->end_longitude;
            $pool->end_lattitude = $request->end_lattitude;
            $pool->timeframe = $request->timeframe;
            $pool->preference = $request->preference;
            $pool->num_of_poolers = $request->num_of_poolers;
            $pool->luggage_capacity = $request->luggage_capacity;
            $pool->expected_fare = $request->expected_fare;
            $pool->per_person_fare = $request->per_person_fare;
            $pool->seats_full = $request->seats_full;
            
            if ($pool->save()) {
                return response()->json([
                            'status' => true,
                            'error' => [],
                            'code' => '200',
                            'message' => 'Pool created successfully'
                ]);
            } else {
                return response()->json([
                            'status' => false,
                            'error' => ['message' => 'Pool not created! Please try again!'],
                            'code' => '401',
                            'message' => 'Pool not created! Please try again!'
                ]);
            }
        } else {
            return response()->json($this->accessError);
        }
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

}
