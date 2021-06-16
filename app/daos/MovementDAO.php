<?php

class MovementDAO extends Phalcon\Mvc\Controller {

    /**
     * MovementDAO get the user personal record leaderboard by movement id.
     * @param integer $id
     * @return Object
     */
    public function getPersonalRecordByMovement($id) {
        return $this->modelsManager->createBuilder()
            ->columns(['u.name user_name', 'm.name move_name', 'MAX(p.value) score', 'p.date'])
            ->addFrom('PersonalRecord', 'p')
            ->join('User', 'u.id = p.user_id', 'u')
            ->join('Movement', 'm.id = p.movement_id', 'm')
            ->where('p.movement_id = :movement_type:', ['movement_type' => $id])
            ->groupBy('p.user_id')
            ->orderBy(['score DESC', 'user_name DESC'])
            ->getQuery()
            ->execute();
    }
}
