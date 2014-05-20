<?php
/**
 *  Update Xml file
 */

include("autoloader.php");

if(isset($_REQUEST['xml'])){
    // xml
    $xml    = $_REQUEST['xml'];
    // xml file
    $path   = $_REQUEST['path'];
    $model = new BbcRssModel();
    $xml = $model->getFeedsFromWebsite($xml);
    $update = new XmlManager();
    $xml = $update->storyListToXml($xml);
    $update->updateRssFeeds($xml,$path);
}