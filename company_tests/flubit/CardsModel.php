<?php
/**
 * Class CardsModel
 * A model to generate array of cards
 */

include_once("Card.php");

class CardsModel {

    private static $TOTAL_CARDS   = 14;
    private static $HEART         = "Heart";
    private static $DIAMOND       = "Diamond";
    private static $SPADE         = "Spade";
    private static $CLUB          = "Club";


    /**
     * Create cards, and return cards
     * @return array Card
     */
    public function getCards(){
        $cards = $this->createCards();
        $cards = $this->shuffleCards($cards);
        return $cards;
    }

    /**
     * Creates individual card
     *
     * @see Card
     *
     * @param $value
     * @param $info
     * @param $suit
     * @param $position
     * @return Card
     */
    private function createCard($value,$info,$suit,$position){
        /** @var  $card */
        $card = new Card();
        // set card values
        $card->setValue((int) $value);
        $card->setInfo($info);
        $card->setSuit($suit);
        $card->setPosition((int) $position);
        // return Card
        return $card;
    }

    /**
     * @return mixed
     */
    private function createCards(){

        // card value
        $v = 2;
        // card index
        $i = 1;

        while($v <= self::$TOTAL_CARDS){
            // info for non numerical cards
            switch($v){
                case 11: $info = "Jack";
                    break;
                case 12: $info = "Queen";
                    break;
                case 13: $info = "King";
                    break;
                case 14: $info = "Ace";
                    break;
                default: $info = (string) $v;
                    break;
            }
            // create all required cards
            $cards[$i] =  $this->createCard($v,$info,self::$HEART,$i);$i++;
            $cards[$i] =  $this->createCard($v,$info,self::$CLUB,$i);$i++;
            $cards[$i] =  $this->createCard($v,$info,self::$DIAMOND,$i);$i++;
            $cards[$i] =  $this->createCard($v,$info,self::$SPADE,$i);$i++;

            $v++;
        }
        // create 2 Jokers
        $cards[$i] =  $this->createCard(99, "Joker",null,$i);$i++;
        $cards[$i] =  $this->createCard(99, "Joker",null,$i);


        return $cards;
    }

    /**
     * @param $cards
     * @return mixed
     */
    private function shuffleCards($cards){
        // times to shuffle
        $times = rand(60, 70);
        for($i =0; $i<$times; $i++){
            $c1 = 0;
            $c2 = 0;
            // random card index
            while($c1 == $c2){
                $c1 = rand(1, 54);
                $c2 = rand(1, 54);
            }
            // temp pointer
            $card = $cards[$c1];
            // change card1 pointer to card2 pointer
            $cards[$c1] = $cards[$c2];
            $cards[$c1]->setPosition($c1);
            // assign card2 pointer to card 1 pointer
            $cards[$c2] = $card;
            $cards[$c2]->setPosition($c2);
        }
        return $cards;
    }
} 