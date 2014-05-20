<?php
/**
 *  This class is a List of all stories from xml or website
 */

class StoryList {

    public $stories;

    public function __construct(){
        $this->stories = array();
    }
    /**
     * Adds a story to the story List
     * @param Story $story
     */
    public function addStory(Story $story){
        array_push($this->stories, $story);
    }

    /**
     * Sort Stories by Alphabet
     */
    public function sortByAlphabet(){

        foreach($this->stories as $key => $story){

            if(array_key_exists(substr($story->getTitle(), 0, 2), $this->stories)){
                $this->stories[substr($story->getTitle(), 0, 2).$key] = $story;
            }else{
                $this->stories[substr($story->getTitle(), 0, 2)] = $story;
            }
            unset($this->stories[$key]);
        }

        ksort($this->stories);

    }

} 