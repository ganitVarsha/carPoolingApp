<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Pool extends Model {

    /**
     * @param string $start_longitude start longitude of one searching for pool
     * @param string $start_latitude start latitude of one searching for pool
     * @param string $end_longitude start longitude of one searching for pool
     * @param string $end_latitude start latitude of one searching for pool
     * @param array $rider_detail rider details array
     * @param int $attempt recursively call time 
     * @return array pools available
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function getAvailablePool($start_longitude = '', $start_latitude = '', $end_longitude = '', $end_latitude = '', $rider_detail = [], $attempt = 0) {
        if ($attempt < 3) {
            $preference_condition = ' and ('
                    . '(preference = "all") '
                    . 'or (preference = "female" and "' . $rider_detail->gender . '" = "female") '
                    . 'or (preference = "male" and "' . $rider_detail->gender . '" = "male") '
                    . 'or (preference = "best match" and users.gender = "' . $rider_detail->gender . '" and users.nature = "' . $rider_detail->nature . '" and (NOT (users.profession IS NOT NULL XOR "' . $rider_detail->profession . '" IS NOT NULL))) '
                    . ') ';
            try {
                $data = DB::select(
                                "SELECT pools.*, "
                                . "round(111.111 * DEGREES(ACOS(COS(RADIANS($start_latitude)) * COS(RADIANS(start_latitude)) * COS(RADIANS($start_longitude - start_longitude)) + SIN(RADIANS($start_latitude)) * SIN(RADIANS(start_latitude)))),2) AS start_distance,"
                                . "round(111.111 * DEGREES(ACOS(COS(RADIANS($end_latitude)) * COS(RADIANS(end_latitude)) * COS(RADIANS($end_longitude - end_longitude)) + SIN(RADIANS($end_latitude)) * SIN(RADIANS(end_latitude)))),2) AS end_distance, "
                                . "(SELECT value FROM settings WHERE settings_name = 'radius') as radius, "
                                . "users.first_name, users.last_name, users.app_user_id, users.gender , users.api_token, users.nature, users.profession "
                                . "FROM pools "
                                . "LEFT JOIN users on users.id = pools.user_id "
                                . "WHERE num_of_poolers <> seats_full "
                                . "and pool_end_time > CURRENT_TIME() "
                                . "$preference_condition "
                                . "HAVING (start_distance < ( radius" . " + " . ($attempt * 500) . ")" . " and end_distance < (radius " . " + " . ($attempt * 0.500) . ")) "
                                . "ORDER BY start_distance "
                                . "LIMIT 0 , 20"
                );

                if (empty($data)) {
                    $this->getAvailablePool($start_longitude, $start_latitude, $end_longitude, $end_latitude, $rider_detail, $attempt++);
                }
                return $data;
            } catch (QueryException $ex) {
                error_log("getAvailablePool " . date('Y-m-d H:i:s') . ": " . $ex->getMessage());
                return false;
            }
        } else {
            return false;
        }
    }

}
