<?php

/**
 * @file
 * Index file.
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Slim\Views\PhpRenderer;
use PruebaPhp\util\db\QueryMysql;
use PruebaPhp\controllers\pais\OverviewController;
use PruebaPhp\controllers\pais\ViewController;
use PruebaPhp\controllers\pais\EditController;
use PruebaPhp\controllers\pais\UpdateController;

$config = [];
require 'settings.php';
require '../../vendor/autoload.php';
$c = new Container(['settings' => $config] );

$app = new App($c);

// Set Slim container.
$container = $app->getContainer();
$container['view'] = new PhpRenderer('../templates/');
$container['db'] = function ($c) {
  $db = $c['settings']['db'];
  $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['pass']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};
$container['dbMysql'] = new QueryMysql($container['db']);


$app->get('/pais', OverviewController::class);
$app->get('/pais/{id}', ViewController::class);
$app->get('/pais/{id}/edit', EditController::class);
$app->post('/pais/{id}/edit', UpdateController::class);

$app->get('/registro', function (Request $request, Response $response) {
  $response = $this->view->render($response, 'registro.phtml');
  return $response;
});

$app->post('/registro', function (Request $request, Response $response) {
  $body = $request->getBody();
  $response->getBody()->write($body);
  return $response;
});

$app->run();
