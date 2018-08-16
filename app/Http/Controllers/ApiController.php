<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Pool;
use App\Transformers\Json;
use \Illuminate\Database\QueryException;
use App\PoolRider;
use App\Classes\Common;

class ApiController extends Controller {

    /**
     * @param array $request data received in API
     * @return [json] API status
     * @author Varsha Mittal
     * @since 30-07-2018
     */
    public function setPool(Request $request) {
        if (!empty($request->header('AccessToken')) || in_array($request->header('AccessToken'), $request->session()->get('accessTokens'))) {
            $user_id = User::getUserIdOnToken($request->header('AccessToken'));
            $pool = new Pool();
            $pool->user_id = $user_id[0]->id;
            $pool->start_location = $request->start_location;
            $pool->start_longitude = $request->start_longitude;
            $pool->start_latitude = $request->start_latitude;
            $pool->end_location = $request->end_location;
            $pool->end_longitude = $request->end_longitude;
            $pool->end_latitude = $request->end_latitude;
            $pool->timeframe = $request->timeframe;
            $pool->preference = $request->preference;
            $pool->num_of_poolers = $request->num_of_poolers;
            $pool->luggage_capacity = $request->luggage_capacity;
            $pool->expected_fare = $request->expected_fare;
            $pool->per_person_fare = $request->per_person_fare;
            $pool->seats_full = $request->seats_full;
            if ($request->timeframe == "15 min") {
                $pool->pool_end_time = date('Y-m-d H:i:s', strtotime("+15 minutes"));
            } else if ($request->timeframe == "30 min") {
                $pool->pool_end_time = date('Y-m-d H:i:s', strtotime("+30 minutes"));
            } else if ($request->timeframe == "1 hour") {
                $pool->pool_end_time = date('Y-m-d H:i:s', strtotime("+60 minutes"));
            }
            try {
                if ($pool->save()) {
                    Common::logActivity($user_id[0]->id, 'Pool Created via API', $pool->id());
                    return response()->json(Json::response(true, 'Pool created successfully!', 200));
                } else {
                    Common::logActivity($user_id[0]->id, 'Error while creating pool via API');
                    return response()->json(Json::response(false, 'Pool not created! Please try again!', 401));
                }
            } catch (QueryException $ex) {
                Common::logActivity($request->header('AccessToken'), 'Error while creating pool | Query Exception via API');
                return response()->json(Json::response(false, $ex->getMessage(), 401));
            } catch (Exception $ex) {
                Common::logActivity($request->header('AccessToken'), 'Error while creating pool | normal Exception via API');
                return response()->json(Json::response(false, $ex->getMessage(), 401));
            }
        } else {
            Common::logActivity($request->header('AccessToken'), 'Error while creating pool | Access Token Mismatch via API');
            return response()->json(Json::$accessError);
        }
    }

    /**
     * @param array $request data received in API logitude, latitude, preference
     * @author Varsha Mittal
     * @since 31-07-2018
     * @return [json] pool list
     */
    public function getPool(Request $request) {
        if (in_array($request->header('AccessToken'), $request->session()->get('accessTokens'))) {
            $user = User::where('api_token', $request->header('AccessToken'))->first();
            $data = Pool::getAvailablePool($request->start_longitude, $request->start_latitude, $request->end_longitude, $request->end_latitude, $user);
            if (!empty($data)) {
                Common::logActivity($request->header('AccessToken'), 'Pool data received via API');
                return response()->json(Json::response(true, 'Pool data received!', 200, $data));
            } else {
                Common::logActivity($request->header('AccessToken'), 'No Pool data available via API');
                return response()->json(Json::response(true, 'No Pool available!', 200));
            }
        } else {
            Common::logActivity($request->header('AccessToken'), 'Error in fetching Pool data | Access Token Mismatch via API');
            return response()->json(Json::$accessError);
        }
    }

    /**
     * to add a user into pool
     * @param array $request data received in API --> pool id
     * @return [json] true or false status of api
     * @author Varsha Mittal
     * @since 01-08-2018
     */
    public function connectToPool(Request $request) {
        if (in_array($request->header('AccessToken'), $request->session()->get('accessTokens'))) {
            $user = User::where('api_token', $request->header('AccessToken'))->first();
            $poolRider = new PoolRider();
            $poolRider->user_id = $user->id;
            $poolRider->pool_id = $request->pool_id;
            try {
                if ($poolRider->save()) {
                    if (Pool::updateSeat($request->pool_id)) {
                        Common::logActivity($request->header('AccessToken'), 'connectToPool via API', $request->pool_id);
                        return response()->json(Json::response(true, 'Pool Rider saved successfully!', 200));
                    } else {
                        $id = $poolRider->id();
                        PoolRider::delete($id);
                        Common::logActivity($request->header('AccessToken'), 'error in connectToPool update seat count failed via API', $request->pool_id);
                        return response()->json(Json::response(false, 'Error in adding rider to pool!', 401));
                    }
                } else {
                    Common::logActivity($request->header('AccessToken'), 'error in saving into pool_riders table connectToPool via API', $request->pool_id);
                    return response()->json(Json::response(false, 'Error in adding rider to pool!', 401));
                }
            } catch (QueryException $e) {
                error_log("connectToPool " . date('Y-m-d H:i:s') . ":" . $e->getMessage());
                Common::logActivity($request->header('AccessToken'), 'connectToPool | Query Exception via API', $request->pool_id);
                return response()->json(Json::response(false, 'Error in adding rider to pool!', 401));
            }
        } else {
                Common::logActivity($request->header('AccessToken'), 'connectToPool | Access Token mismatch via API', $request->pool_id);
            return response()->json(Json::$accessError);
        }
    }

}
