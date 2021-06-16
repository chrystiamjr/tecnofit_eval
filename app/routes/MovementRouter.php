<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$movement = new MicroCollection();
$movement->setHandler(new MovementController());
$movement->setPrefix('/movement');

// Fetch the leaderboard of users per movement.
$movement->get('/leaderboard/{movement_type:[0-9]+}', 'fetchLeaderboardByMovement');

$app->mount($movement);