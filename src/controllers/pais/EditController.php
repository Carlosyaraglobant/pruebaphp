<?php

namespace PruebaPhp\controllers\pais;

use PruebaPhp\controllers\ControllerBase;
use PruebaPhp\model\mysql\StoragePais;

class EditController extends ControllerBase {

  public function __invoke($request, $response, $args) {
    $id = $args['id'];
    $pais = NULL;
    if ($id) {
      $storage = new StoragePais($this->container->dbMysql);
      $pais = $storage->getById($id);
    }
    $response = $this->container->view->render($response, '/pais/edit.phtml', ['pais' => $pais]);
    return $response;
  }

}
