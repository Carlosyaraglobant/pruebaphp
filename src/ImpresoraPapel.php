<?php

namespace PruebaPhp;

class ImpresoraPapel implements Imprimible {

  protected $estado = 1;

  /**
   * function imprimir.
   */
  public function imprimir(string $mensaje = "") : void {
    if ($this->estado == 1) {
      echo "La impresora imprime en papel: $mensaje";
    }
    else {
      echo "La impresora en papel esta apagada";
    }
  }

}
