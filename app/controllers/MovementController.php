<?php

namespace Tecnofit\Controller;

use Exception;
use Tecnofit\Dao\MovementDAO;
use Tecnofit\Dto\LeaderboardDTO;
use Tecnofit\Dto\MovementDTO;

class MovementController extends BaseController {

    /**
     * MovementController get list of movements.
     */
    public function fetchMovement() {
        try {
            $records = (new MovementDAO())->getMovement();
            $response = (new MovementDTO())->mapList($records);
            $this->sendResponse(200, $response);
        } catch(Exception $e) {
            $this->sendResponse(400, null, [$e->getMessage()]);
        }
    }

    /**
     * MovementController get single movement by id.
     * @param integer $id
     */
    public function fetchMovementById($id) {
        try {
            $records = (new MovementDAO())->getMovementById($id);
            $response = (new MovementDTO())->mapList($records);
            $this->sendResponse(200, $response);
        } catch(Exception $e) {
            $this->sendResponse(400, null, [$e->getMessage()]);
        }
    }

    /**
     * MovementController get the user personal record leaderboard by movement id.
     * @param integer $id
     */
    public function fetchLeaderboardByMovementId($id) {
        try {
            $records = (new MovementDAO())->getPersonalRecordByMovementId($id);
            $response = (new LeaderboardDTO())->getLeaderboard($records);

            $this->sendResponse(200, $response);
        } catch(Exception $e) {
            $this->sendResponse(400, null, [$e->getMessage()]);
        }
    }

    public function upsertMovement()
}