<?php

class MovementController extends BaseController {
  
    public function fetchLeaderboardByMovement($movement_type) {
        try {
            $builder = $this->modelsManager->createBuilder();

            $rows = $builder
                ->columns(['u.name user_name', 'm.name move_name', 'MAX(p.value) score', 'p.date'])
                ->addFrom('PersonalRecord', 'p')
                ->join('User', 'u.id = p.user_id', 'u')
                ->join('Movement', 'm.id = p.movement_id', 'm')
                ->where('p.movement_id = :movement_type:', ['movement_type' => $movement_type])
                ->groupBy('p.user_id')
                ->orderBy(['score DESC', 'user_name DESC'])
                ->getQuery()
                ->execute();

            $this->sendResponse(200, $this->setRatingPerRow($rows));
        } catch(Exception $e) {
            $this->sendResponse(400, null, [$e->getMessage()]);
        }
    }

    private function setRatingPerRow($rows) {
        $rating = 0;
        $parsedArr = [];
        $lastScore = $rating;
        foreach($rows as $row) {
            if($lastScore != $row->score) {
                $rating++;
                $lastScore = $row->score;
            }

            $dto = new LeaderboardDTO();
            $dto->position  = $rating;
            $dto->score     = $row->score;
            $dto->user      = $row->user_name;
            $dto->movement  = $row->move_name;
            $dto->date      = $row->date;

            $parsedArr[] = $dto;
        }

        return $parsedArr;
    }
}