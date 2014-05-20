<?php

/**
 * Model to get feeds from xml files (internal and external)
 */

class BbcRssModel {

    public  static $BBC_TECHNOLOGY = "http://feeds.bbci.co.uk/news/technology/rss.xml";
    public  static $BBC_TECHNOLOGY_XML = "../files/xml/bbctechnology.xml";

    /**
     * Gets Internal bbc feeds
     * @param $xml
     * @return StoryList
     */
    public function getBccFeeds($xml){

        $xml    = simplexml_load_file($xml);
        $xmlManager = new XmlManager();
        $storyList = $xmlManager->xmlToStoryList($xml);

       return $storyList;
    }

    /**
     * Gets feeds from bbs website (external)
     * @param $xml
     * @return StoryList
     */
    public function getFeedsFromWebsite($xml){

        $xml    = simplexml_load_file($xml);

        $extract    = new ImageExtractor();
        $storyList  = new StoryList();

        foreach($xml->channel->item as $key => $value){
            $story = new Story();
            $story->setTitle($value->title->__toString());
            $story->setDescription($value->description->__toString());
            $story->setLink($value->guid->__toString());
            $story->setPubDate($value->pubDate->__toString());
            $story->setImageUrl($extract->extractStoryImage($story->getLink()));

            $storyList->addStory($story);
        }

        return $storyList;

    }

} 