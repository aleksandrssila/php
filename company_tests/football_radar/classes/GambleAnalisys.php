<?php
/**
 * This class is analysing game results gambles
 */

include_once("GameAnalisys.php");

class GambleAnalisys {

    private $teamSupporterMoney;
    private $gambleResults;

    public function __construct(){
       $this->teamSupporterMoney = array();
        $this->gambleResults = array();
    }

    /**
     * @param $season
     * @return array
     */
    public function analyseGamble($season){
        $this->createGambleResults($season);
        /** @var $result Result */
        foreach($this->gambleResults as $key => $result){
            if(array_key_exists($result->getHomeTeam(),$this->teamSupporterMoney)){
                $this->teamSupporterMoney[$result->getHomeTeam()] =
                    $this->teamSupporterMoney[$result->getHomeTeam()]+$result->getHomeTeamSupporterCash();
            }else{
                $this->teamSupporterMoney[$result->getHomeTeam()] = $result->getHomeTeamSupporterCash();
            }
            if(array_key_exists($result->getAwayTeam(),$this->teamSupporterMoney)){
                $this->teamSupporterMoney[$result->getAwayTeam()] =
                    $this->teamSupporterMoney[$result->getAwayTeam()]+$result->getAwayTeamSupporterCash();
            }else{
                $this->teamSupporterMoney[$result->getAwayTeam()] = $result->getAwayTeamSupporterCash();
            }
        }

        return $this->teamSupporterMoney;
    }

    /**
     * Analyse each game of the season and place result
     * into gambling result list
     * @param $season
     */
    private function createGambleResults($season){
        $analisys   = new GameAnalisys();
        foreach($season as $key => $game){
            $result = $analisys->analyseGame($game);
            array_push($this->gambleResults,$result);
        }
    }
} 