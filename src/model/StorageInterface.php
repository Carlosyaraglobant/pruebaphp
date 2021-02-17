<?php

namespace PruebaPhp\model;

interface StorageInterface {

  public function create(Model $model);
  public function update(Model $model);
  public function delete(Model $model);
  public function getById(String $id) : Model;

}
