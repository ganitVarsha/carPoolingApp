<?php

namespace App\Classes;

class Common {

    /**
     * @params array $array Array to be remapped
     * @params array $column Array to be column name against which array has to be remapped
     * @return array remapped array
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     */
    public function mapArray($array = [], $column = '') {
        try {
            if (empty($array)) {
                throw new Exception('Array is empty');
            }
            if ($column == '') {
                throw new Exception('Column not defined');
            }
            $remapped_array = [];
            foreach ($array as $key => $value) {
                $remapped_array[$value->$column] = $value;
            }
            return $remapped_array;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Create a random string
     * @param $length the length of the string to create
     * @return $str the string
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     */
    public static function randomString($length = 16) {
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
     * Logging user activity
     * @param $user_relevant_id app_id/access_token/id of user performing action
     * @param $activity name of API or WebPage accessed
     * @param $other_id id which is used in API
     * @return boolean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     */
    public static function logActivity($user_relevant_id = '', $activity = '', $other_id = '') {
        $user_id = (($user_relevant_id != '' ) ? \App\User::getUserRelevantId($user_relevant_id) : '');
        $userLog = new \App\userLog();
        $userLog->user_id = (!empty($user_id)) ? $user_id[0]->id : '0';
        $userLog->other_id = (($other_id == '') ? '0' : $other_id);
        $userLog->api_or_webpage = $activity;
        $userLog->save();
        return true;
    }

    /**
     * Logging user activity
     * @param $sendAsData 1->send as data, 0-> send as notification
     * @param $data contains data ike title, body, image, icon, sound etc
     * @param $registrationIds ids on which msg is to be delivered
     * @return boolean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 02-08-2018
     */
    public static function sendPushNotification($sendAsData = false, $data = [], $registrationIds = '') {
        #API access key from Google API's Console
        define('API_ACCESS_KEY', 'YOUR-SERVER-API-ACCESS-KEY-GOES-HERE');

        #prep the bundle
        $msg = array
            (
            'body' => 'Body  Of Notification',
            'title' => 'Title Of Notification',
            'icon' => 'myicon', /* Default Icon */
            'sound' => 'mySound'/* Default sound */
        );
        $fields = array
            (
            'to' => $registrationIds
        );

        if ($sendAsData) {
            $fields['data'] = [
                "title" => "my title",
                "message" => "my message",
                "image" => "http://www.androiddeft.com/wp-content/uploads/2017/11/Shared-Preferences-in-Android.png",
                "action" => "url",
                "action_destination" => "http://androiddeft.com"
            ];
        } else {
            $fields['notification'] = $msg;
        }

        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        #Send Reponse To FireBase Server	
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        #Echo Result Of FireBase Server
        return $result;
    }

}
