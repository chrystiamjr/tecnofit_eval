<?php

class LeaderboardDTO implements JsonSerializable {

    /**
     * @var integer
     */
    private $position;

    /**
     * @var string
     */
    private $movement;

    /**
     * @var string
     */
    private $user;

    /**
     * @var double
     */
    private $score;

    /**
     * @var string
     */
    private $date;

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getMovement()
    {
        return $this->movement;
    }

    /**
     * @param string $movement
     */
    public function setMovement($movement)
    {
        $this->movement = $movement;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * LeaderboardDTO constructor.
     * @param integer $position
     * @param Object $leaderboard
     */
    public function __construct($position = 0, $leaderboard = null) {
        if(!is_null($leaderboard)) {
            $this->position = $position;
            $this->score = $leaderboard->score;
            $this->user = $leaderboard->user_name;
            $this->movement = $leaderboard->move_name;
            $this->date = $leaderboard->date;
        }
    }

    /**
     * LeaderboardDTO get leaderboard based on query records.
     * @param Object[] $records
     * @return LeaderboardDTO[]
     */
    public function getLeaderboard($records) {
        $position = 0;
        $lastScore = 0;
        $parsedArr = [];
        foreach($records as $row) {
            if($lastScore != $row->score) {
                $position++;
                $lastScore = $row->score;
            }

            $parsedArr[] = new LeaderboardDTO($position, $row);
        }
        return $parsedArr;
    }

    /**
     * Serialize private attributes of the class
     * @return array
     */
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
