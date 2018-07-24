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
     * Show the application App Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function app() {
        if (auth()->user()->isAdmin == 1) {
            return view('settings.app');
        } else {
            return view('home');
        }
    }
    
    /**
     * Show the application Page Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function page() {
        if (auth()->user()->isAdmin == 1) {
            return view('settings.page');
        } else {
            return view('home');
        }
    }
    
    /**
     * Show the application Web Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function web() {
        $list = Setting::execute('getValuesBasedOnScope', ['scope' => 'Web']);
//        $commonFunction = new Common; //error in accessing the class
//        $list = $commonFunction->mapArray($list, 'settings_name');
        $list = $this->mapArray($list, 'settings_name');
        if (auth()->user()->isAdmin == 1) {
            return view('settings.web', [
                'list' => $list
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
    public function webUpdate() {
        $update = Setting::execute('updateValues', ['fields' => $_POST, 'files'=> $_FILES]);
    }
    
     private function mapArray($array = [], $column = '') {
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
}
