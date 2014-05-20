<?php
/**
 *
 * Extracts images from web pages
 */
class ImageExtractor {

    /**
     * Extracts images from bbc website story
     * @param $url
     * @return null
     */
    public function extractStoryImage($url){

        $html = file_get_contents($url);

        $doc = new DOMDocument();
        @$doc->loadHTML($html);

        $images = $doc->getElementsByTagName('img');

        $storyImageUrl = null;
        $height = 0;

        foreach ($images as $image){
            if($image->getAttribute('height')>0){
                if($image->getAttribute('height') > $height){
                    $height     = $image->getAttribute('height');
                    $storyImageUrl = $image->getAttribute('src');
                }
            }
        }

        return $storyImageUrl;

    }

} 