<?php

namespace PruebaPhp\model\mysql;

use PruebaPhp\model\StorageInterface;
use PruebaPhp\model\Model;
use PruebaPhp\model\Pais;
use PruebaPhp\util\db\QueryInterface;

class StoragePais implements StorageInterface {

  protected $query;


  protected $tableName = 'pais';

  public function __construct(QueryInterface $query) {
    $this->query = $query;
  }

  public function create(Model $pais) {
    $columns = ['name'];
    $values = [$pais->getNombre()];
    $this->query->insert($this->tableName, $columns, $values);
  }

  public function update(Model $pais) {
    $updateValues = [
      ['column' => 'name', 'value' => $pais->getNombre()],
    ];
    $conditions = [
      ['column' => 'id', 'value' => $pais->getId()],
    ];
    $this->query->update($this->tableName, $updateValues, $conditions);
  }

  public function delete(Model $pais) {
    $conditions = [
      ['column' => 'id', 'value' => $pais->getId()],
    ];
    $this->query->delete($this->tableName, $conditions);
  }

  public function getById(String $id) : Model {
    $conditions = [
      ['column' => 'id', 'value' => $id],
    ];
    $paises = $this->query->find($this->tableName, [], $conditions);
    if (!count($paises)) {
      return NULL;
    }
    $paisData = array_shift($paises);
    $pais = new Pais($paisData['name'], $paisData['id']);
    return $pais;
  }

  public function getAll() {
    $paisesData = $this->query->find($this->tableName);
    $paises = [];
    foreach ($paisesData as $paisData) {
      $paises[] = new Pais($paisData['name'], $paisData['id']);
    }
    return $paises;
  }

}
