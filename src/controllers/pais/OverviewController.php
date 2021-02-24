<?php

namespace PruebaPhp\controllers\pais;

use PruebaPhp\controllers\ControllerBase;
use PruebaPhp\model\mysql\StoragePais;

class OverviewController extends ControllerBase {

  public function __invoke($request, $response, $args) {
    $storage = new StoragePais($this->container->dbMysql);
    $paises = $storage->getAll();

    $response = $this->container->view->render($response, '/pais/overview.phtml', ['paises' => $paises]);
    return $response;
  }

}
