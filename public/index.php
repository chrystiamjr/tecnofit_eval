<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require_once APP_PATH . '/dtos/index.php';
require_once APP_PATH . '/daos/index.php';

try {
    $di = new FactoryDefault();

    include APP_PATH . '/config/services.php';

    $config = $di->getConfig();

    include APP_PATH . '/config/loader.php';

    $app = new Micro($di);

    include APP_PATH . '/app.php';

    $app->handle();

} catch (\Exception $e) {
      echo $e->getMessage() . '<br>';
      echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
