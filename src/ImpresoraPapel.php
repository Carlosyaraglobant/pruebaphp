<?php

namespace PruebaPhp;

class ImpresoraPapel extends Impresora {

  /**
   * function imprimir.
   */
  public function imprimir($mensaje = "") {
    if ($this->estado == 1) {
      echo "La impresora imprime en papel: $this->mensaje";
    }
    else {
      echo "La impresora en papel esta apagada";
    }
  }

}
