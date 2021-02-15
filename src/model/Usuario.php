<?php

namespace PruebaPhp\model;

class Usuario {

  protected $id;
  protected $nombre;
  protected $apellido;
  protected $idPais;

  public function getId() {
    return $this->id;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getApellido() {
    return $this->apellido;
  }

  public function getIdPais() {
    return $this->idPais;
  }

}
