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
