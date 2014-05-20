<?php
session_start();
include_once("../functions/autoloader.php");


$page = new RssFeedController();
$page->loadFeedsAction();
