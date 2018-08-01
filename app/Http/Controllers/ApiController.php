<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Pool;
use App\Transformers\Json;
use \Illuminate\Database\QueryException;

class ApiController extends Controller {

    /**
     * @param array $request data received in API
     * @return [json] API status
     * @author Varsha Mittal
     * @since 30-07-2018
     */
    public function setPool(Request $request) {
        if (!empty($request->accessToken) || in_array($request->accessToken, $request->session()->get('accessTokens'))) {
            $user_id = User::getUserIdOnToken($request->accessToken);
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

            try {
                if ($pool->save()) {
                    return response()->json(Json::response(true, 'Pool created successfully!', 200));
                } else {
                    return response()->json(Json::response(false, 'Pool not created! Please try again!', 401));
                }
            } catch (QueryException $ex) {
                return response()->json(Json::response(false, $ex->getMessage(), 401));
            } catch (Exception $ex) {
                return response()->json(Json::response(false, $ex->getMessage(), 401));
            }
        } else {
            return response()->json(Json::$accessError);
        }
    }

    /**
     * @param array $request data received in API logitude, latitude, preference
     * @author Varsha Mittal
     * @since 31-07-2018
     * @return [json] user object
     */
    public function getPool(Request $request) {
        if (in_array($request->accessToken, $request->session()->get('accessTokens'))) {
            $data = Pool::getAvailablePool($request->longitude, $request->latitude, $request->preference);
            if (!empty($data)) {
                return response()->json(Json::response(true, 'Pool data received!', 200, $data));
            } else {
                return response()->json(Json::response(false, 'No Pool available!', 401));
            }
        } else {
            return response()->json(Json::$accessError);
        }
    }

}
