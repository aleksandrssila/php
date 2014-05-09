<?php
/**
 */

include_once("Classes/Fibonacci.php");

$test = new Fibonacci();
$sum = $test->start();
echo $sum;
