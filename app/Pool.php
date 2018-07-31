<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Pool extends Model {

    /**
     * @param string $longitude longitude
     * @param string $latitude latitude
     * @param string $preference preference
     * @return array user profile data
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function getAvailablePool($longitude = '', $latitude = '', $preference = 'all') {
        $preference_condition = '';
        if ($preference == 'male') {
            $preference_condition = "and gender = 'male'";
        } else if ($preference == 'female') {
            $preference_condition = "and gender = 'female'";
        }
        echo "SELECT pools.*, (6371 * acos ( cos ( radians($longitude) ) * cos( radians( start_latitude ) ) * cos( radians( start_longitude ) - radians($latitude) ) + sin ( radians($longitude) ) * sin( radians( start_latitude ) ) ) ) AS distance,  users.first_name, users.last_name, users.app_user_id, users.gender , users.api_token
                    FROM pools
                    WHERE num_of_poolers <> seats_full $preference_condition 
                    HAVING distance < (SELECT value FROM settings WHERE settings_name = 'radius')
                    ORDER BY distance
                    LIMIT 0 , 20";die;
        try {
            $data = DB::select(
                            "SELECT pools.*, (6371 * acos ( cos ( radians($longitude) ) * cos( radians( start_latitude ) ) * cos( radians( start_longitude ) - radians($latitude) ) + sin ( radians($longitude) ) * sin( radians( start_latitude ) ) ) ) AS distance,  users.first_name, users.last_name, users.app_user_id, users.gender , users.api_token
                    FROM pools
                    LEFT JOIN users on users.id = pools.user_id
                    WHERE num_of_poolers <> seats_full $preference_condition 
                    HAVING distance < (SELECT value FROM settings WHERE settings_name = 'radius')
                    ORDER BY distance
                    LIMIT 0 , 20"
            );
            return $data;
        } catch (QueryException $ex) {
            error_log("getAvailablePool ".date('Y-m-d H:i:s').": " . $ex->getMessage());
            return false;
        }
    }

}
