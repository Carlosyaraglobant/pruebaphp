<?php

namespace PruebaPhp\controllers\pais;

use PruebaPhp\controllers\ControllerBase;
use PruebaPhp\model\mysql\StoragePais;

class UpdateController extends ControllerBase {

  public function __invoke($request, $response, $args) {
    $id = $args['id'];
    $body = $request->getParsedBody();
    if ($id) {
      $storage = new StoragePais($this->container->dbMysql);
      $pais = $storage->getById($id);
      $pais->setName($body['name']);
      $storage->update($pais);
    }
    return $response->withRedirect('/pais');
  }

}
