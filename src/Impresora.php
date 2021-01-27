<?php

namespace PruebaPhp;

/**
 * Impresora class.
 */
class Impresora {

  protected $estado = 0;

  protected $mensaje;

  /**
   * function imprimir.
   */
  public function imprimir($mensaje = "") {
    if (!empty($mensaje)) {
      echo "La impresora imprime: $mensaje";
    } else {
      if ($this->estado == 1) {
        echo "La impresora imprime: $this->mensaje";
      }
      else {
        echo "La impresora esta apagada";
      }
    }
  }

  public function agregarMensaje(string $mensaje) {
    $this->mensaje = $mensaje;
  }

  /**
   * encederImpresora
   *
   * @return void
   */
  public function encederImpresora() {
    $this->estado = 1;
  }

  /**
   * apagarImpresora
   *
   * @return void
   */
  public function apagarImpresora() {
    $this->estado = 0;
  }

}
