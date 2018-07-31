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

}
