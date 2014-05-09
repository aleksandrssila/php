<?php
/**
 * Class Player
 * Defines behavior of the player
 */

class Player {
    /**
     * @var $name string (Name of the player)
     * @var $card1 Card (Player 1st card)
     * @var $card2 Card (Player 2nd card)
     * @var $memory array (Array of cards that player remember)
     */
    private $name;
    private $card1;
    private $card2;
    public $memory;


    public function __construct($name){
        $this->name = $name;
        $this->memory = array();
    }

    /**
     * Recursion function
     * Take 1st card, card will be not from previously taken
     * @param $cards
     * @return bool
     */
    public function takeCard1($cards){

        $check = $this->checkPairs();

        if($check instanceof Card){
            $this->card1 = $check;
            return;
        }else{
            /** @var Card $card */
            $card = $this->takeCard($cards);

            if($this->countKeys() < count($cards)){
                // check memory
                $check = isset($this->memory[$card->getValue()][$card->getPosition()]);
                // if random card was taken previously, take card again
                if($check){
                    $this->takeCard1($cards);
                }else{
                    $this->card1 = $card;
                    return;
                }
            }else{
                $this->card1 = $card;
                return;
            }
        }
    }

    /**
     * Take second card, if there is a pair for first card, take matched cart
     * @param $cards
     * @return bool
     */
    public function takeCard2($cards){
        $card = null;
        // check memory for similar card
        $check = isset($this->memory[$this->card1->getValue()]);
        // check if card in memory is not the same card
        if($check){
            $mCards = $this->memory[$this->card1->getValue()];
            foreach($mCards as $key => $value){
                if($this->card1->getPosition()!==$value->getPosition()){
                    $card = $value;
                    break;
                }
            }
        }
        // if card is not the same, set card2
        if($card instanceof Card){
            /** @var Card $card */
            $this->card2 = $card;
            return;
        }
        else{
            // take random unique card
            $card = $this->takeCard($cards);
            // check if is not the same card
            if($this->card1 === $card){
                $this->takeCard2($cards);
            }
            else{
                $this->card2 = $card;
                return;
            }
        }
    }

    /**
     * Player is analysing cards with this function
     * @param $cards
     * @return null
     */
    public function analizyCards($cards){
        // check if next cards are last, if so deal with them
        $continue = $this->checkForLastPair($cards);
        // remove all values from memory and cards
        if(!$continue){
            $this->removeCardFromMemory($this->card1);
            $this->removeCardFromMemory($this->card2);
            $cards = null;
            return $cards;
        }
        // get cards value
        $card1 = $this->card1->getValue();
        $card2 = $this->card2->getValue();
        // show what player have taken
        $this->sayMyCards($this->card1, $this->card2);
        // equal cards, or Joker
        if(($card1 == $card2)||($card1==99)||($card2==99)){
            unset($cards[$this->card1->getPosition()]);
            unset($cards[$this->card2->getPosition()]);
            $this->sayRemovedCards($this->card1,$this->card2);
            $this->removeCardFromMemory($this->card1);
            $this->removeCardFromMemory($this->card2);
        }
        else{
            // check memory for duplicates, and remember the cards
            if(count($cards) > $this->countKeys()){
                if(!isset($this->memory[$this->card1->getValue()][$this->card1->getPosition()])){
                    $this->addCardToMemory($this->card1);
                }
                if(!isset($this->memory[$this->card2->getValue()][$this->card2->getPosition()])){
                    $this->addCardToMemory($this->card2);
                }
            }
        }

        return $cards;
    }

    /**
     * Check last pair of cards, if they are not equal end game
     * @param $cards
     * @return bool
     */
    private function checkForLastPair($cards){
        if(count($cards) < 3){
            $last = array_values($cards);
            if($last[0]->getValue() !== $last[1]->getValue()){
                if(($last[0]->getValue()==99)||$last[1]->getValue()==99){
                    return true;
                }else{
                    $this->sayLast2Cards($last[0], $last[1]);
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param $cards
     * @return mixed
     */
    private function takeCard($cards){
        $num = array_rand($cards, 1);
        return $cards[$num];
    }

    /**
     * Remove card from human memory
     * @param Card $card
     */
    private function removeCardFromMemory(Card $card){
        $keys = count($this->memory[$card->getValue()]);
        if($keys >1){
            unset($this->memory[$card->getValue()][$card->getPosition()]);
        }else{
            unset($this->memory[$card->getValue()]);
        }
    }

    /**
     * Add card to human memory
     * @param Card $card
     */
    private function addCardToMemory(Card $card){
        $this->memory[$card->getValue()][$card->getPosition()] = $card;
    }

    /**
     * Returns total amount of cards in player memory
     * @return int
     */
    public function countKeys(){
        $i = 0;
        foreach($this->memory as $key => $value){
            $i = $i + count($this->memory[$key]);
        }
        return $i;
    }

    /**
     * Check memory if there are any pairs
     * @return bool
     */
    private function checkPairs(){
        foreach($this->memory as $key => $value){
            $array = array_values($this->memory[$key]);
            if(count($array)>1){
                return $array[0];
            }
        }

        return false;
    }

    /**
     * Prints last 2 cards left in the game
     * @param Card $card1
     * @param Card $card2
     */
    private function sayLast2Cards(Card $card1, Card $card2){
        echo "<br>";
        echo $this->name.": I have last 2 cards, they can not go to bank";
        echo "<br>";
        echo $card1->getCardName()." and ".$card2->getCardName()." are left";
    }

    /**
     * Print cards that player have
     * @param Card $card1
     * @param Card $card2
     */
    private function sayMyCards(Card $card1, Card $card2){
        echo $this->name." took: ".$card1->getCardName()." and ".$card2->getCardName();
        echo "<br>";
    }

    /**
     * Prints cards that were removed
     * @param Card $card1
     * @param Card $card2
     */
    private function sayRemovedCards(Card $card1, Card $card2){
        echo "---------- ";
        echo $card1->getCardName()." and ".$card2->getCardName()." are removed";
        echo " ----------<br>";
    }

    /**
     * Returns Player name
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }


} 