<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Include Routes
 */
require_once APP_PATH. '/routes/MovementRouter.php';


$app->notFound(function () use($app) {
    return (new BaseController())->notFound();
});
