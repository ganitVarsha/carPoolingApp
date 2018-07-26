<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
     * @params string $phone phone number of user
     * @params string $token api_token
     * @return booblean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 26-07-2018
     */
    public static function saveToken($phone, $token) {
        DB::table('users')
                            ->where('phone', $phone)
                            ->update(['api_token' => $token]);
        return true;           
    }
    
    /**
     * @params string $phone phone number of user
     * @params string $token api_token
     * @return booblean true
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 26-07-2018
     */
    public static function removeToken($phone, $token) {
        DB::table('users')
                            ->where(['phone'=> $phone, 'api_token'=> $token])
                            ->update(['api_token' => '']);
        return true;           
    }
}
