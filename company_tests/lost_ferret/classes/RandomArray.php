<?php
/**
 * Class random array
 */

class RandomArray {

    private $array;

    public function __construct(){
        $this->array = array();
    }

    /**
     * creates a random valued multidimentional array with float and int numbers
     * @return mixed
     */
    public function generateMultidimensionalArray(){
        $parents            = rand(50,100);
        $totalChildren      = rand(100,120);
        $i = 1;
        while($parents > $i){
            $valid = false;
            while(!$valid){
                $key = "key_".rand(100,1000);
                if(array_key_exists($key,$this->array)){
                    $valid = false;
                }
                else{
                    $this->array[$key] = array();
                    $valid = true;
                }
            }
            $i++;
        }
        $i = 0;
        while(count($totalChildren) > $i){
            $rand_keys = array_rand($this->array, 4);
            foreach($rand_keys as $key => $value){
                $children = rand(1,6);
                $this->array[$value] = $this->addChildren($this->array[$value],$children);
                $this->array[$value] = $this->addGrandChild($this->array[$value]);
            }
            $i++;
        }
        $this->array = $this->fillArray($this->array);
        return $this->array;

    }

    /**
     * Add a child to array
     * @param $parent
     * @param $int
     * @return mixed
     */
    private function addChildren($parent,$int){
        $i = 1;
        while($i < $int){
            $child = array();
            $child["child_".$i] = array();
            array_push($parent,$child);
            $i++;
        }

        foreach($parent as $key => $value){
            $temp = $parent[$key];
            $parent["key_".$key] = $temp;
            unset($parent[$key]);
        }

        return $parent;
    }

    /**
     * Add a grand son to array
     * @param $array
     * @return mixed
     */
    private function addGrandChild($array){
        foreach($array as $key => $value){
            if(is_numeric($key)){
                $key = "key_".$key;
            }
            if(is_array($array[$key])){
                $grandChildren = rand(1,6);
                $array[$key] = $this->addChildren($array[$key],$grandChildren);
            }
        }
        return $array;
    }

    /**
     * Recursional function
     * @param $array
     * @return mixed
     */
    private function fillArray($array){
        if(count($array)>0){
            foreach($array as $key => $value){
                if(is_numeric($key)){
                    $key = "key_".$key;
                }
                if(is_array($value)){
                    $array[$key] = $this->fillArray($value);
                }
                $array = $this->fillArrayWithData($array);
            }
        }
        else{
            $array = $this->fillArrayWithData($array);
        }
        return $array;
    }

    /**
     * Fill random data to array
     * @param $array
     * @return mixed
     */
    private function fillArrayWithData($array){
        $data = rand(4,10);
        $i = 1;
        while($data > $i){
            $randKey = rand(23,100);
            $float = rand(1,3);
            if($float <3){
                $array["rand_".$randKey] = $this->randomFloat(4,10);
            }
            else{
                $array["rand_".$randKey] = rand(0,100);
            }
            $i++;
        }
        return $array;
    }

    /**
     * Generate random float number
     * @param $min
     * @param $max
     * @return mixed
     */
    private function randomFloat($min,$max) {
        return ($min+lcg_value()*(abs($max-$min)));
    }

} 