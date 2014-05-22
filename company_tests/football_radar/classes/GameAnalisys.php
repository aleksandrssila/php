<?php
/**
 * This class is analysing game and sets outcome of the gamble
 */

include_once("Result.php");

class GameAnalisys {

    private static $BET = 10;

    /**
     * Analyse geme, return result
     * @param $game
     * @return Result
     */
    public function analyseGame($game){

        $result = new Result();

        $result->setAwayTeam($game['AwayTeam']);
        $result->setHomeTeam($game['HomeTeam']);

        $htGoals = $game['FTHG'];
        $aTGoals = $game['FTAG'];

        // set score
        $score = $htGoals-$aTGoals;
        /*
         * Analise score of the game
         */
        // home team win
        if($score > 0){
            $result->setHomeTeamSupporterCash(self::$BET*$game['B365H']);
            $result->setAwayTeamSupporterCash(-self::$BET);
        }
        // draw
        else if($score == 0){
            $result->setHomeTeamSupporterCash(-self::$BET);
            $result->setAwayTeamSupporterCash(-self::$BET);
        }
        // home team lost
        else if($score<0){
            $result->setHomeTeamSupporterCash(-self::$BET);
            $result->setAwayTeamSupporterCash(self::$BET*$game['B365A']);
        }

        return $result;
    }
} 