<?php

namespace Tecnofit\Dao;

use Phalcon\Mvc\Controller;

class MovementDAO extends Controller {

    /**
     * MovementDAO get list of movements.
     * @return Object
     */
    public function getMovement() {
        return $this->modelsManager->createBuilder()
            ->addFrom('Tecnofit\Model\Movement', 'm')
            ->getQuery()
            ->execute();
    }

    /**
     * MovementDAO get movement by id.
     * @param integer $id
     * @return Object
     */
    public function getMovementById($id) {
        return $this->modelsManager->createBuilder()
            ->addFrom('Tecnofit\Model\Movement', 'm')
            ->where('m.id = :movement_id:', ['movement_id' => $id])
            ->getQuery()
            ->execute();
    }

    /**
     * MovementDAO get the user personal record leaderboard by movement id.
     * @param integer $id
     * @return Object
     */
    public function getPersonalRecordByMovementId($id) {
        return $this->modelsManager->createBuilder()
            ->columns(['u.name user_name', 'm.name move_name', 'MAX(p.value) score', 'p.date'])
            ->addFrom('Tecnofit\Model\PersonalRecord', 'p')
            ->join('Tecnofit\Model\User', 'u.id = p.user_id', 'u')
            ->join('Tecnofit\Model\Movement', 'm.id = p.movement_id', 'm')
            ->where('p.movement_id = :movement_id:', ['movement_id' => $id])
            ->groupBy('p.user_id')
            ->orderBy(['score DESC', 'user_name DESC'])
            ->getQuery()
            ->execute();
    }
}
