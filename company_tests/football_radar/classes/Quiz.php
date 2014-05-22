<?php
/**
 * This Class is talking to Quiz
 */

class Quiz {

    public static $QUIZ_QUESTION = "http://www.footballradar.com/quiz/";
    public static $QUIZ_ANSWER = "http://www.footballradar.com/quiz/answer/";

    /**
     * Make Curl call
     * @param $url
     * @return mixed
     */
    public function makeAcall($url){

       // create curl resource
       $ch = curl_init();

       // set url
       curl_setopt($ch, CURLOPT_URL, $url);

       //return the transfer as a string
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

       // $output contains the output string
       $output = curl_exec($ch);
       // close curl resource to free up system resources
       curl_close($ch);

       return $output;

    }

    /**
     * Get numeric values
     * @param $output
     * @return int
     */
    public function filterAswer($output){
        $string = explode(self::$QUIZ_ANSWER,$output);
        $string = explode("{",$string[1]);
        $string = explode("}",$string[1]);
        echo $string[0]."<br>";
        return $this->calculateString($string[0]);
    }

    /**
     * String to int
     * @param $mathString
     * @return int
     */
    private function calculateString($mathString ){
        $mathString = trim($mathString);
        $mathString = preg_replace ('[^0-9\+-\*\/\(\) ]', '', $mathString);
        $compute = create_function("", "return (" . $mathString . ");" );
        return 0 + $compute();
    }

}