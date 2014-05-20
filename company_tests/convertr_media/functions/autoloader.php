<?php
/**
 * Autoload all classes
 */

function __autoload($class_name){

    $classFile    = $class_name.".php";
    $classes      = "../classes/";
    $models       = "../application/models/";
    $controllers  = "../application/controllers/";
    $entities     = "../application/entities/";

    if(file_exists($classes.$classFile)){
        include_once($classes.$classFile);
    }
    else if(file_exists($models.$classFile)){
        include_once($models.$classFile);
    }
    else if(file_exists($controllers.$classFile)){
        include_once($controllers.$classFile);
    }else if(file_exists($entities.$classFile)){
        include_once($entities.$classFile);
    }

}