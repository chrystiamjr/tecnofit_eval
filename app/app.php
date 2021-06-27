<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

use Tecnofit\Controller\BaseController;

require_once APP_PATH. '/routes/MovementRouter.php';

$app->notFound(function () use($app) {
    return (new BaseController())->notFound();
});
