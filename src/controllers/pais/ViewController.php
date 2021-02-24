<?php

namespace PruebaPhp\controllers\pais;

use PruebaPhp\controllers\ControllerBase;
use PruebaPhp\model\mysql\StoragePais;

class ViewController extends ControllerBase {

  public function __invoke($request, $response, $args) {
    $id = $args['id'];
    if ($id) {
      $storage = new StoragePais($this->container->dbMysql);
      $pais = $storage->getById($id);
      var_dump($pais);
    }
    return $response;
  }

}
