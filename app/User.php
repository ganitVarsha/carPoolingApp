<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    use Notifiable,
        HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @params string $value phone number or email of user
     * @params string $token api_token
     * @return booblean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 26-07-2018
     */
    public static function saveToken($value, $token) {
        DB::table('users')
                ->where('email', $value)
                ->orWhere('phone', $value)
                ->update(['api_token' => $token]);
        return true;
    }

    /**
     * @params string $value phone number or email of user
     * @params string $token api_token
     * @return booblean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 26-07-2018
     */
    public static function removeToken($value, $token) {
        DB::table('users')
                ->where(['email' => $value, 'api_token' => $token])
                ->orWhere(['phone' => $value, 'api_token' => $token])
                ->update(['api_token' => '']);
        return true;
    }

    /**
     * @params string $token api_token
     * @return array user profile data
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function getProfileData($token) {
        $data = DB::table('users')
                ->where(['api_token' => $token])
                ->select('id', 'first_name', 'last_name', 'gender', 'dob', 'email', 'isd', 'phone', 'profession', 'nature')
                ->get();
        return $data;
    }

    /**
     * @params string $token api_token
     * @params array $updateData data to be updated
     * @return boolean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function setProfileData($token = '', $updateData = '') {
        if ($token == '' || $updateData == '') {
            $data = DB::table('users')
                    ->where(['api_token' => $token])
                    ->update($updateData);
            return true;
        } else {
            return false;
        }
    }

}
