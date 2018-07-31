<?php

namespace App\Transformers;

class Json {

    public static $accessError = [
        'status' => false,
        'message' => 'Acces Token mismatch!',
        'error_code' => '401'
    ];

    /**
     * Create Response
     * @params [boolean] $status true or false
     * @params [string] $message custome message to request
     * @params [int] $error_code error code against request
     * @params [array] $data data to be sent to user
     * @return [array] response array
     * @author Varsha
     * @since 31-07-2018
     */
    public static function response($status = false, $message = 'Request failed.', $error_code = 200, $data = []) {
        $response = [
            'status' => $status,
            'message' => $message,
            'error_code' => $error_code,
        ];

        if (!empty($data))
            $response['data'] = $data;

        return $response;
    }

}
