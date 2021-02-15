<?php

namespace PruebaPhp\util\db;

interface QueryInterface {

  /**
   * insert
   *
   * @param  mixed $tableName
   * @param  mixed $columns
   * @param  mixed $values
   * @return void
   */
  public function insert(String $tableName, array $columns, array $values);

  public function delete(String $tableName, array $conditions);

}
