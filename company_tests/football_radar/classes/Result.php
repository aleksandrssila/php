<?php
/**
 * Entity for the Game result
 */

class Result {

    private $homeTeam;
    private $awayTeam;
    private $homeTeamSupporterCash;
    private $awayTeamSupporterCash;

    /**
     * @param mixed $awayTeam
     */
    public function setAwayTeam($awayTeam)
    {
        $awayTeam = preg_replace('/\s+/', '', $awayTeam);
        $awayTeam = strtolower($awayTeam);
        $this->awayTeam = $awayTeam;
    }

    /**
     * @param mixed $awayTeamSupporterCash
     */
    public function setAwayTeamSupporterCash($awayTeamSupporterCash)
    {
        $this->awayTeamSupporterCash = $awayTeamSupporterCash;
    }

    /**
     * @param mixed $homeTeam
     */
    public function setHomeTeam($homeTeam)
    {
        $homeTeam = preg_replace('/\s+/', '', $homeTeam);
        $homeTeam = strtolower($homeTeam);
        $this->homeTeam = $homeTeam;
    }

    /**
     * @param mixed $homeTeamSupporterCash
     */
    public function setHomeTeamSupporterCash($homeTeamSupporterCash)
    {
        $this->homeTeamSupporterCash = $homeTeamSupporterCash;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @return mixed
     */
    public function getAwayTeamSupporterCash()
    {
        return $this->awayTeamSupporterCash;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @return mixed
     */
    public function getHomeTeamSupporterCash()
    {
        return $this->homeTeamSupporterCash;
    }

} 