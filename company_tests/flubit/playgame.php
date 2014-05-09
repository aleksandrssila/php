<?php
/**
 * Game execution file
 */

include_once("CardsModel.php");
include_once("Player.php");
ini_set('error_reporting', 1);
/*
 ******Main Entities******
 */
/** @var CardsNodel $model */
$model  = new CardsModel();
/** @var Player $player */
$player = new Player("John");
// cards array
$cards  = $model->getCards();
/*
 * Play game while there are cards left
 */
while(!empty($cards)){
    $player->takeCard1($cards);
    $player->takeCard2($cards);
    $cards = $player->analizyCards($cards);
}




