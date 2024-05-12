<?php

use Alura\Fp\Maybe;

/** @var Maybe $dados */
$dados = require 'dados.php';

// $brasil = $dados[0];

$somaMedalhas = fn (int $medalhasAcumuladas, int $medalhas) => $medalhasAcumuladas + $medalhas;

// $numeroDeMedalhas = array_reduce($brasil['medalhas'], $somaMedalhas, 0);
// echo $numeroDeMedalhas;

$medalhasAcumuladas = fn (int $medalhasAcumuladas, array $pais) => $medalhasAcumuladas + array_reduce($pais['medalhas'], $somaMedalhas, 0);

echo (string) Maybe::of(array_reduce($dados->getOrElse([]), $medalhasAcumuladas, 0));