<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model {
    
    /**
     * @params string $token api_token
     * @return array user profile data
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function getAvailablePool($token) {
        $data = DB::table('users')
                ->where(['api_token' => $token])
                ->select('id', 'first_name', 'last_name', 'gender', 'dob', 'email', 'isd', 'phone', 'profession', 'nature')
                ->get();
        return $data;
    }


}
