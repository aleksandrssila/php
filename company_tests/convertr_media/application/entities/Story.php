<?php
/**
 * Story Entity
 */

class Story {

    private $title;
    private $description;
    private $link;
    private $pubDate;
    private $imageUrl;

    /**
     * Set title of the story
     * @param $title
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     * Set description of the story
     * @param $description
     */
    public function setDescription($description){
        $this->description = $description;
    }

    /**
     * Set link tot the bbc news story
     * @param $link
     */
    public function setLink($link){
        $this->link = $link;
    }

    /**
     * @param $pubDate
     */
    public function setPubDate($pubDate){
        $this->pubDate = $pubDate;
    }

    /**
     * @param $imageUrl
     */
    public function setImageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLink(){
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getPubDate(){
        return $this->pubDate;
    }

    /**
     * @return mixed
     */
    public function getImageUrl(){
        return $this->imageUrl;
    }
} 