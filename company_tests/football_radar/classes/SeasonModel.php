<?php
/**
 *  Gets data from cvs and returns data array
 */
include_once("CvsManager.php");

class SeasonModel {

    /**
     * Gets Season 2009-2010
     * @return mixed
     */
    public function getSeason2009and2010(){

        $cvsManager = new CvsManager();
        $cvsArray = $cvsManager->getArrayFromFile($cvsManager::$SEASON_2009_2010);
        $keys = $cvsManager->getKeys($cvsArray);
        $season = $cvsManager->organiseSeasonArray($keys,$cvsArray);

        return $season;
    }

} 