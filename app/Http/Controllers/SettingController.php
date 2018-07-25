<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use App\Setting;
use App\Classes\Common;

class SettingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Show the application Web Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($settings_type = 'app', $updated = false) {
        $list = Setting::execute('getValuesBasedOnScope', ['scope' => ucfirst($settings_type)]);
        $commonFunction = new Common; 
        $list = $commonFunction->mapArray($list, 'settings_name');
        if (auth()->user()->isAdmin == 1) {
            return view("settings.$settings_type", [
                'list' => $list,
                'updated' => $updated
            ]);
        } else {
            return view('home');
        }
    }
    
    /**
     * Update the application Web Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($settings_type) {
        $update = Setting::execute('updateValues', ['fields' => $_POST, 'files'=> $_FILES]);
        if($update){
            return $this->show($settings_type, true);
        }
    }
}
