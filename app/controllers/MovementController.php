<?php

class MovementController extends BaseController {

    /**
     * MovementController get the user personal record leaderboard by movement id.
     * @param integer $id
     */
    public function fetchLeaderboardByMovement($id) {
        try {
            $records = (new MovementDAO())->getPersonalRecordByMovementId($id);
            $response = (new LeaderboardDTO())->getLeaderboard($records);

            $this->sendResponse(200, $response);
        } catch(Exception $e) {
            $this->sendResponse(400, null, [$e->getMessage()]);
        }
    }
}