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
use PruebaPhp\ImpresoraPapel;
use PruebaPhp\Impresora;
use Modelo\user\Usuario;

require '../../vendor/autoload.php';
$configuration = [
  'settings' => [
    'displayErrorDetails' => TRUE,
  ],
];
$c = new Container($configuration);
$app = new App($c);

// Set Slim container.
$container = $app->getContainer();
$container['view'] = new PhpRenderer('../templates/');

$app->get('/', function (Request $request, Response $response) {

  $impresora = new ImpresoraPapel();

  $usuario = new Usuario("Nombre", "Apellido");

  $nombre = $usuario->imprimirNombre($impresora);

  echo "<br>";

  // $impresoraHija = new ImpresoraPapel();
  // $impresoraHija->encederImpresora();
  // $impresoraHija->agregarMensaje("HOLA JULIAN");
  // $impresoraHija->imprimir();
  // echo "<br>";
  // $impresoraHija->apagarImpresora();
  // $impresoraHija->imprimir();

  // echo "<br>";

  // $impresoraHija2 = new ImpresoraPapel();
  // $impresoraHija2->agregarMensaje("HOLA DIEGO");
  // $impresoraHija2->imprimir();

  return $response;
});

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
