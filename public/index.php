<?php
use Framework\MVC\Router;

error_reporting(E_ALL | E_STRICT) ;
ini_set('display_errors', 'On');

include '../Framework/init.php';

$di = new \Framework\DI\DI();

$router = new Router();

$router->add('/', [
    "controller" => 'Index',
    "action"     => 'index',
    'namespace' => 'App\\Controllers\\Site',
]);

$router->add('/news', [
    "controller" => 'News',
    "action"     => 'index',
    'namespace' => 'App\\Controllers\\Site',
]);

$router->add('/news/add', [
    "controller" => 'News',
    "action"     => 'add',
    'namespace' => 'App\\Controllers\\Site',
], ['POST']);

$di->set('router', $router);

$app = new \Framework\MVC\Application();
$app->setDI($di);
echo $app->handle()->getContent();