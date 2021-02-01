<?php

namespace Modelo\user;

use PruebaPhp\Imprimible;

class Usuario {

  protected $nombre;
  protected $apellido;

  function __construct($nombre = "", $apellido = "") {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

  public function getNombre() {
    return $this->nombre . " " . $this->apellido;
  }

  public function imprimirNombre(Imprimible $impresora) {

    $impresora->imprimir($this->getNombre());
  }

}
