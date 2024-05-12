<?php

use Alura\Fp\Maybe;

/** @var Maybe $dados */
$dados = require 'dados.php';

// $contador = 0;

// foreach ($dados as $pais) {
//   $contador++;
// }

// array_walk($dados, function($pais) use(&$contador) {
//   $contador++;
// });

$contador = count($dados->getOrElse([]));

echo "Numero de países: $contador\n";

function convertePaisParaLetraMaiuscula(array $pais)
{
  $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
  return $pais;
}

$verificaSePaisTemEspacoNoNome = fn (array $pais): bool => strpos($pais['pais'], ' ') !== false;

$nomeDePaisesEmMaiusculo = fn(Maybe $dados) => Maybe::of(array_map('convertePaisParaLetraMaiuscula', $dados->getOrElse([])));
$filtraPaisesSemEspacoNoNome = fn(Maybe $dados) => Maybe::of(array_filter($dados->getOrElse([]), $verificaSePaisTemEspacoNoNome));

function pipe(callable ...$funcoes) {
  return fn($valor) => array_reduce(
    $funcoes,
    fn($valorAcumulado, callable $funcaoAtual) => $funcaoAtual($valorAcumulado),
    $valor,
  );
}

$funcoes = pipe($filtraPaisesSemEspacoNoNome, $nomeDePaisesEmMaiusculo);
$dados = $funcoes($dados);

var_dump($dados);

