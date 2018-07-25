<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    /**
     * @params string functionName Name of the function to be executed
     * @params array $params Array of the parameters to be passed in the function
     * @return int/array/string Depends on what the function returns
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 24-07-2018
     */
    public static function execute($functionName = '', $params = []) {
        try {
            if ($functionName == '') {
                throw new Exception("Please define a command to execute!");
            }
            $_this = new self;
            return $_this->$functionName($params);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @params array $params [scope]
     * @return array list of all the configurable values in that scope
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 24-07-2018
     */
    private function getValuesBasedOnScope($params) {
        $scope = $params['scope'];
        $settings = [];
        $settings = DB::table('settings')
                ->where('scope', $scope)
                ->get()
                ->toArray();
        return $settings;
    }

    /**
     * @params array $params [column=>value]
     * @return array list of all the configurable values in that scope
     * @author Varsha Mittal <varsha.mittal@ganitsoftech.com>
     * @since 24-07-2018
     */
    private function updateValues($params) {
        unset($params['fields']['_token']);
        unset($params['fields']['_method']);
        echo "<pre>"; print_r($params);
        //error : file values are manupilated if the are empty
        if (isset($params['files'])) {
            foreach ($params['files'] as $setting_name => $val) {
                if ($val['tmp_name']['name'] != '') {
                    echo "<br> $setting_name : Name not null";
                    DB::table('settings')
                            ->where('settings_name', $setting_name)
                            ->update(['value' => $val['tmp_name']['name'], 'is_active' => ((isset($params['fields'][$setting_name]['active']) && ($params['fields'][$setting_name]['active'] == 'on')) ? '1' : '0')]);
                    unset($params['fields'][$setting_name]);
                } else {
                    echo "<br> $setting_name : Name null";
                    $params['fields'][$setting_name]['name'] = '';
                }
            }
        }
        print_r($params);
        if (isset($params['fields'])) {
            foreach ($params['fields'] as $setting_name => $val) {
                    echo "<br> $setting_name : ".$val['name'];
                if ($val['name'] != '') {
                    $update['value'] = trim($val['name']);
                }
                $update['is_active'] = ((isset($val['active']) && ($val['active'] == 'on')) ? '1' : '0');
                DB::table('settings')
                        ->where('settings_name', $setting_name)
                        ->update($update);
            }
        }
        die;
        return true;
    }

}
