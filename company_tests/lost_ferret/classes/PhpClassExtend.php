<?php
/**
 * Class PhpClassExtend
 */
class PhpClassExtend extends PhpClass {

    public function __construct(){
        parent::getInstance();
    }
    /**
     * Rounds all float numbers in array
     * @param $array
     * @return mixed
     */
    private function roundValues($array){
        foreach($array as $key => $value){
            if(strlen($value)>1){
                $value = floatval($value);
                if(is_float($value)){
                    $array[$key] = round($value);
                }
            }
        }
        return $array;
    }

    /**
     * Stores rounded results results
     * @Override storeResultToXmlFile()
     */
    public function storeResultToXmlFile($array,$path){
        $array = $this->roundValues($array);
        // creating object of SimpleXMLElement
        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
        // function call to convert array to xml
        $this->arrayToXml($array,$xml);
        //saving generated xml file
        $xml->asXML($path);
    }
} 