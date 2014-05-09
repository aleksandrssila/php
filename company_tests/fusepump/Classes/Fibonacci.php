<?php
/**
 *
 * Congratulations, the answer you gave to problem 2 is correct.
 * You are the 305489th person to have solved this problem.
 */

class Fibonacci {


    private static $MAXIMUM_SUMM = 4000000;
    private $num;
    private $num2;
    private $num3;
    private $sum;

    public function __construct(){
        $this->num  = 0;
        $this->num2 = 1;
        $this->sum  = 0;
    }

    /**
     * Start executing
     * @return bool
     */
    public function start(){
        $continue = true;
        while($continue){
            // 1st,2nd,3rd number
            $this->num3  = $this->num + $this->num2;
            $this->num   = $this->num2;
            $this->num2  = $this->num3;
            // check if number is even
            if(($this->num3%2==0)){
                $this->sum = $this->sum + $this->num3;
            }
            // if number is exceeding maximum number
            if($this->num3 >= self::$MAXIMUM_SUMM){
                $continue = false;
            }
        }
        return $this->sum;
    }
} 