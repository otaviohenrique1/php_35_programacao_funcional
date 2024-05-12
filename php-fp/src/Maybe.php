<?php

namespace Alura\Fp;

class Maybe
{
  private mixed $valor;

  public function __construct(mixed $valor)
  {
    $this->valor = $valor;
  }

  public static function of($valor)
  {
    return new self($valor);
  }

  public function getOrElse($default)
  {
    return $this->isNothing() ? $default : $this->valor;
  }

  public function isNothing(): bool
  {
    return $this->valor === null;
  }
  
  public function map(callable $fn)
  {
    if ($this->isNothing()) {
      return Maybe::of($this->valor);
    }

    $valor = $fn($this->valor);
    return Maybe::of($valor);
  }
}
