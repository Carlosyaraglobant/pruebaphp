<?php

namespace PruebaPhp\model;

class Pais implements Model {

  protected $id;
  protected $nombre;

  public function __construct(String $nombre, String $id = NULL) {
    $this->nombre = $nombre;
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }
  public function getNombre() {
    return $this->nombre;
  }

  public function setName($nombre) {
    $this->nombre = $nombre;
  }

}
