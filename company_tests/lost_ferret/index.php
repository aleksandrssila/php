<?php

/**
 *
 */
echo '<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>';
echo "<script src='./js/js.js'></script>";
include_once("./functions/autoloader.php");


echo '<form name="input" action="" method="post">';
echo '<input type="submit" name="t1" value="Task1">';
echo '<input type="submit" name="t2" value="Task2">';
echo '</form>';
echo '<br><br>';


if(isset($_POST['t1'])){
    echo '<form name="input" action="" method="post">';
    echo 'NAME: <input id="name" type="name" name="email">';
    echo 'Email: <input id="email" type="email" name="email">';
    echo 'Phone: <input id="phone" type="text" name="email">';
    echo '<input type="button" onclick="
                callPhpScriptToValidate($(\'#name\').val(),
                                        $(\'#email\').val(),
                                        $(\'#phone\').val())" value="Submit">';
    echo '</form>';
    echo '<br>';
    echo '<p id="message"></p>';
}

if(isset($_POST['t2'])){

    /** @var  $class PhpClass */
    $class = PhpClass::getInstance();
    /** @var  $extended PhpClassExtend*/
    $extended = new PhpClassExtend();


    echo "Please Open Xml files to test <br>";
    echo "<a href=".$class::$XML_MULTI." target='_blank'>multi</a><br>";
    echo "<a href=".$class::$XML_FLAT." target='_blank'>flat</a><br>";

    $random = new RandomArray();
    $random = $random->generateMultidimensionalArray();
    // will store array to muldidimentional xml
    $class->storeResultToXmlFile($random,$class::$XML_MULTI);
    // load multid array
    $multi = $class->loadMultidimensionalArrayFromXml($class::$XML_MULTI);
    // convert array to flattern array
    $flatt = $extended->convertToFlatternArray($multi);
    // rounds numbers and stores them
    $extended->storeResultToXmlFile($flatt,$extended::$XML_FLAT);

}

