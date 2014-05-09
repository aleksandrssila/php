<?php
/**
 * Class Card
 * This class is an Entity for Card
 */
class Card {

    /**
     * @var $value int (cards value: 2,3,4,5 and etc..)
     * @var $info string (cards info: 3,4,5,King,Ace and etc..)
     * @var $suit string (cards suit: Diamonds,Heart and etc..)
     * @var $position int (cards position in the array)
     */
    private  $value;
    private  $info;
    private  $suit;
    private  $position;

    /**
     * Set card value
     * @param $value
     */
    public function setValue($value){
        $this->value = $value;
    }

    /**
     * Set card info
     * @param string $info
     */
    public function setInfo($info){
        $this->info = $info;
    }

    /**
     * Set card suit
     * @param string $suit
     */
    public function setSuit($suit){
        $this->suit = $suit;
    }

    /**
     * Set card position
     * @param $position
     */
    public function setPosition($position){
        $this->position = $position;
    }

    /**
     * Get card value
     * @return mixed
     */
    public function getValue(){
        return $this->value;
    }

    /**
     * Get card info
     * @return mixed
     */
    public function getInto(){
        return $this->info;
    }

    /**
     * Get card suit
     * @return mixed
     */
    public function getSuit(){
        return $this->suit;
    }

    /**
     * Get card position
     * @return mixed
     */
    public function getPosition(){
        return $this->position;
    }

    /**
     * Get card name
     * @return string
     */
    public function getCardName(){
        if($this->value < 99){
            return $this->info." of ".$this->suit."s";
        }else{
            return $this->info;
        }
    }
} 