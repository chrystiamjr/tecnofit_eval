<?php

/**
 * Registering an autoloader
 */

use Phalcon\Loader;

$loader = new Loader();
$loader->registerNamespaces((array) $config->namespaces)->register();
