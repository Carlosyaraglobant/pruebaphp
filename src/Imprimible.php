<?php

namespace PruebaPhp;

interface Imprimible {
  /**
   * imprimir
   *
   * @param  mixed $mensaje
   * @return void
   */
  public function imprimir(string $mensaje) : void;

}
