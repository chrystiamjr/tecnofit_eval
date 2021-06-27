<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Tecnofit\Controller\MovementController;

$movement = new MicroCollection();
$movement->setHandler(new MovementController());
$movement->setPrefix('/movement');

# Fetch all movement data
$movement->get('/', 'fetchMovement');

# Fetch single movement data
$movement->get('/{movement_id:[0-9]+}', 'fetchMovementById');

# Fetch the leaderboard of users per movement.
$movement->get('/leaderboard/{movement_id:[0-9]+}', 'fetchLeaderboardByMovementId');

$app->mount($movement);