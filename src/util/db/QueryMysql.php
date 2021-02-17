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
    $whereConditions = [];
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

  /**
   *
   */
  public function update(String $tableName, array $updateValues, array $conditions) {

    $setValues = [];
    $values = [];
    foreach ($updateValues as $updateValue) {
      if ($updateValue['column'] && $updateValue['value']) {
        $setValues[] = $updateValue['column'] . " = ?";
        $values[] = $updateValue['value'];
      }
    }
    $setString = implode(", ", $setValues);
    if (empty($setString)) {
      return;
    }

    $whereConditions = [];
    foreach ($conditions as $condition) {
      if ($condition['column'] && $condition['value']) {
        $operator = isset($condition['operator']) ? $condition['operator'] : '=';
        $whereConditions[] = $condition['column'] . " " . $operator . " ?";
        $values[] = $condition['value'];
      }
    }
    $whereString = implode(" AND ", $whereConditions);
    if (empty($whereString)) {
      return;
    }
    $query = "UPDATE $tableName SET $setString WHERE $whereString";
    $this->conection->prepare($query)->execute($values);
  }

  /**
   * @{inheret}
   */
  public function find(String $tableName, array $fields = [], array $conditions = [], $typeCondition = "") {
    $whereConditions = [];
    $values = [];
    $fieldsString = count($fields) ? implode(", ", $fields) : "*";
    $query = "SELECT $fieldsString FROM $tableName";
    foreach ($conditions as $condition) {
      if ($condition['column'] && $condition['value']) {
        $operator = isset($condition['operator']) ? $condition['operator'] : '=';
        $whereConditions[] = $condition['column'] . " " . $operator . " ?";
        $values[] = $condition['value'];
      }
    }
    $typeCondition = $typeCondition == "OR" ? $typeCondition : "AND";
    $whereString = implode(" $typeCondition ", $whereConditions);

    if (!empty($whereString)) {
      $query = $query . " WHERE $whereString";
    }
    $stmt = $this->conection->prepare($query);
    $stmt->execute($values);
    return $stmt->fetchAll();
  }

}
