<?php
/**
 * Controls landing page
 */
class RssFeedController {

    public function loadFeedsAction(){
        if(isset($_POST['login'])){
            // do authentication and etc
            $_SESSION['login'] = $_POST['login'];
        }
        if(!empty($_SESSION['login'])){
            $model = new BbcRssModel();
            $this->view->storylist = $model->getBccFeeds($model::$BBC_TECHNOLOGY_XML);
            include_once("./views/feeds.phtml");
        }else{
            include_once("./views/login.phtml");
        }

    }
} 