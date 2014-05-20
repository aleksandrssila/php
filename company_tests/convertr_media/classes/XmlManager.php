<?php
/**
 * This class is used to translate xml to objects and opposite
 */

class XmlManager {

    /**
     * @param StoryList $storyList
     * @return SimpleXMLElement
     */
    public function storyListToXml(StoryList $storyList){

        $xml = new SimpleXMLElement("<?xml version='1.0'?><storylist />");

        foreach($storyList->stories as $key => $value){
            /** @var Story $story */
            $story = $value;
            $storyXml = $xml->addChild("story");
            // asign values to stories
            $storyXml->link         = $story->getLink();
            $storyXml->description  = $story->getDescription();
            $storyXml->title        = $story->getTitle();
            $storyXml->imageUrl     = $story->getImageUrl();
            $storyXml->pubDate      = $story->getPubDate();

        }

        return $xml;
    }

    /**
     * Decode xml to a StroryList object (@see StoryList)
     * @param $xml
     * @return StoryList
     */
    public function xmlToStoryList($xml){

        $storyList = new StoryList();

        foreach($xml as $key => $storyXml){

            $story = new Story();
            $story->setDescription($storyXml->description->__toString());
            $story->setLink($storyXml->link->__toString());
            $story->setImageUrl($storyXml->imageUrl->__toString());
            $story->setTitle($storyXml->title->__toString());
            $story->setPubDate($storyXml->pubDate->__toString());


            $storyList->addStory($story);
        }

        return $storyList;
    }

    /**
     * Update xml file
     * @param $xml
     * @param $path
     */
    public function updateRssFeeds($xml,$path){

        $fp = fopen($path, 'w');
        fwrite($fp, $xml->asXml());
        fclose($fp);
    }

} 