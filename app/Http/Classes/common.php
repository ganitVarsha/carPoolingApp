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

}
