<?php
/**
 * Extracts data from cvs files
 */
class CvsManager {


    public static $SEASON_2009_2010 = "./csv/09-10.csv";


    /**
     * @param $path
     * @return array
     */
    public function getArrayFromFile($path){
        return file($path);
    }

    /**
     * @param $arr
     * @return array
     */
    public function getKeys($arr){
        $keys = $this->getArrayFromCvs($arr[0]);
        return $keys;
    }

    /**
     * @param $string
     * @return array
     */
    private function getArrayFromCvs($string){
        $array = explode(",",$string);
        return $array;
    }

    /**
     * @param $keys
     * @param $matches
     * @return mixed
     */
    public function organiseSeasonArray($keys, $matches){
        unset($matches[0]);
        foreach($matches as $num => $match){
            $match = $this->getArrayFromCvs($match);
            foreach($match as $i=>$value){
                $temp = $value;
                $match[$keys[$i]] = $temp;
                unset($match[$i]);
            }
            $matches[$num] = $match;
        }

        return $matches;
    }


} 