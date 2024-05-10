<?php

$dados = require 'dados.php';

// $contador = 0;

// foreach ($dados as $pais) {
//   $contador++;
// }

// array_walk($dados, function($pais) use(&$contador) {
//   $contador++;
// });

$contador = count($dados);

echo "Numero de países: $contador\n";

function convertePaisParaLetraMaiuscula(array $pais)
{
  $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
  return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
  return strpos($pais['pais'], ' ') !== false;
}

$dados = array_map('convertePaisParaLetraMaiuscula', $dados);
$dados = array_filter($dados, 'verificaSePaisTemEspacoNoNome');

var_dump($dados);
