<?php

use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;


$di->setShared('config', function () {
  return include APP_PATH . "/config/config.php";
});


$di->setShared('url', function () {
  $config = $this->getConfig();

  $url = new UrlResolver();
  $url->setBaseUri($config->application->baseUri);
  return $url;
});


$di->setShared('db', function () {
  $config = $this->getConfig();

  $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
  $params = [
    'host'     => $config->database->host,
    'username' => $config->database->username,
    'password' => $config->database->password,
    'dbname'   => $config->database->dbname,
    'charset'  => $config->database->charset
  ];

  if ($config->database->adapter == 'Postgresql') {
    unset($params['charset']);
  }

  $connection = new $class($params);

  return $connection;
});

$di->setShared(
  'transactions',
  function () { return new TransactionManager(); }
);