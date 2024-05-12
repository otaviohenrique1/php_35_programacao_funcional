<?php

use Alura\Fp\Maybe;

/** @var Maybe $dados */
$dados = require 'dados.php';

$somaMedalhas = fn (int $medalhasAcumuladas, int $medalhas) => $medalhasAcumuladas + $medalhas;

function comparaMedalhas(array $medalhasPais1, array $medalhasPais2): callable
{
  return fn ($modalidade): int => $medalhasPais2[$modalidade] <=> $medalhasPais1[$modalidade];
}

$medalhas = array_reduce(
  array_map(
    fn(array $medalhas) => array_reduce($medalhas, $somaMedalhas, 0),
    array_column($dados->getOrElse([]), 'medalhas')
  ),
  $somaMedalhas,
  0
);

usort($dados->getOrElse([]), function (array $pais1, array $pais2) {
  $medalhasPais1 = $pais1['medalhas'];
  $medalhasPais2 = $pais2['medalhas'];
  $comparador = comparaMedalhas($medalhasPais1, $medalhasPais2);

  return $comparador('ouro') !== 0 ? $comparador('ouro')
    : ($comparador('prata') !== 0 ? $comparador('prata') : $comparador('bronze'));
});

var_dump($dados);
echo $medalhas;
