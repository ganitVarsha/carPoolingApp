<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;

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
                ->where(['email' => $value])
                ->orWhere(['phone' => $value])
                ->update(['api_token' => '']);
        return true;
    }

    /**
     * @params string $token api_token
     * @return int user id
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 30-07-2018
     */
    public static function getUserIdOnToken($token) {
        $data = DB::table('users')
                ->where(['api_token' => $token])
                ->select('id')
                ->get();
        return $data->toArray();
    }

    /**
     * @params string $user_relevant_id app_id/access_token/id of user performing action
     * @return int user id
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 02-08-2018
     */
    public static function getUserRelevantId($user_relevant_id) {
        $data = DB::table('users')
                ->where(['api_token' => $user_relevant_id])
                ->orWhere(['app_user_id' => $user_relevant_id])
                ->orWhere(['id' => $user_relevant_id])
                ->select('id')
                ->get();
        return $data->toArray();
    }

    /**
     * @params string $app_user_id app_user_id
     * @return array user profile data
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function getProfileData($app_user_id) {
        $data = DB::table('users')
                        ->where(['app_user_id' => $app_user_id])
                        ->select('id', 'first_name', 'last_name', 'gender', 'dob', 'email', 'isd', 'phone', 'profession', 'nature')
                        ->get()->first();
        return $data;
    }

    /**
     * @params string $app_user_id app_user_id
     * @params array $updateData data to be updated
     * @return boolean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 27-07-2018
     */
    public static function setProfileData($app_user_id = '', $updateData = []) {
        if ($app_user_id == '' || empty($updateData)) {
            return false;
        } else {
            try {
                $data = DB::table('users')
                        ->where(['app_user_id' => $app_user_id])
                        ->update($updateData);
            } catch (QueryException $e) {
                return false;
                error_log("SetProfileData for $app_user_id :" . $e->getMessage());
            }
            return true;
        }
    }

}
