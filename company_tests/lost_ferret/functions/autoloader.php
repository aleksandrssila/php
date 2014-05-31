<?php
/**
 * Autoloads all classes
 */

function __autoload($class_name){

    $classFile    = $class_name.".php";
    $classes      = "./classes/";
    $core         = "./core/";

    if(file_exists($classes.$classFile)){
        include_once($classes.$classFile);
    }
    else if(file_exists($core.$classFile)){
        include_once($core.$classFile);
    }
}