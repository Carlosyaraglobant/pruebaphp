<?php

namespace PruebaPhp\controllers;

use Psr\Container\ContainerInterface;

class ControllerBase {

  protected $container;

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  public function getContainer() {
    return $this->container;
  }

}
