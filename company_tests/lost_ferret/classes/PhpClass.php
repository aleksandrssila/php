<?php
/**
 * Class PhpClass
 * Uses Singleton pattern
 */

class PhpClass {

    use Singleton;

    public static $XML_MULTI = "./files/xml/multidimensional.xml";
    public static $XML_FLAT  = "./files/xml/flatten.xml";

    private $key;
    private $flatternArray;

    private function __construct(){
        $this->flatternArray = array();
        $this->key = 0;
    }

    /**
     * Loads Multidimentional array from Xml
     * (* Can load a multidimensional array from a given file)
     */
    public function loadMultidimensionalArrayFromXml($path){
        $xml    = simplexml_load_file($path);
        $json   = json_encode($xml);
        $array  = json_decode($json,TRUE);
        return $array;
    }

    /**
     * Converts To Flattern Array
     * @param $array
     * @return array
     */
    public function convertToFlatternArray($array){
        $this->flatterArray($array);
        $return = $this->flatternArray;
        $this->flatternArray = array();
        return $return;
    }

    /**
     * Makes Multidimentional array into flattern array
     * (* Can flatten the array)
     */
    private function flatterArray($array){
        foreach($array as $key => $value){
            if(is_array($value)){
                $this->flatterArray($array[$key]);
            }
            else{
                $this->flatternArray["key_".$this->key] = $value;
                $this->key++;
            }
        }
        return;
    }

    /**
     * Stores array to Xml file
     * (* Can store the result to another given file)
     */
    public function storeResultToXmlFile($array,$path){
        // creating object of SimpleXMLElement
        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
        // function call to convert array to xml
        $this->arrayToXml($array,$xml);
        //saving generated xml file
        $xml->asXML($path);
    }

    /**
     * Converts Array to Xml
     * @param $array
     * @param $xml
     */
    protected function arrayToXml($array, &$xml) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml->addChild("$key");
                    $this->arrayToXml($value, $subnode);
                }
                else{
                    $subnode = $xml->addChild("$key");
                    $this->arrayToXml($value, $subnode);
                }
            }
            else {
                $xml->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }

}