<?php
/**
 *  This is a trait for Singleton patter
 *  How to use it: add "use Singleton;" in the begging of your class
 */

trait Singleton {

    private static $INSTANCE;

    public static function getInstance(){

        $class = __CLASS__;

        if(!(self::$INSTANCE instanceof $class)){
            self::$INSTANCE = new $class();
        }

        return self::$INSTANCE;
    }

} 