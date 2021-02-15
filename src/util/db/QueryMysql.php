<?php

namespace PruebaPhp\util\db;

/**
 *
 */
class QueryMysql implements QueryInterface {

  protected $conection;

  /**
   *
   */
  public function __construct($conection) {
    $this->conection = $conection;
  }

  /**
   * @{inheret}
   */
  public function insert(String $tableName, array $columns, array $values) {

    $valor = count($values);
    $interrogacion = array_fill(0, $valor, "?");
    $columnsString = implode(",", $columns);
    $query = "INSERT INTO $tableName($columnsString) VALUES(" . implode(",", $interrogacion) . ")";

    $this->conection->prepare($query)->execute($values);
  }

  /**
   * @{inheret}
   */
  public function delete(String $tableName, array $conditions) {
    $whereConditions = NULL;
    $values = [];
    foreach ($conditions as $condition) {
      if ($condition['column'] && $condition['value']) {
        $operator = isset($condition['operator']) ? $condition['operator'] : '=';
        $whereConditions[] = $condition['column'] . " " . $operator . " ?";
        $values[] = $condition['value'];
      }
    }
    $whereString = implode(" AND ", $whereConditions);

    $query = "DELETE FROM $tableName WHERE $whereString";
    $this->conection->prepare($query)->execute($values);
  }

}
