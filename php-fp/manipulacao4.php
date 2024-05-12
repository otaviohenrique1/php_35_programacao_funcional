<?php

require_once 'vendor/autoload.php';

use function igorw\pipeline;
use Alura\Fp\Maybe;

/** @var Maybe $dados */
$dados = require 'dados.php';

function convertePaisParaLetraMaiuscula(array $pais)
{
  $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
  return $pais;
}

$verificaSePaisTemEspacoNoNome = fn (array $pais): bool => strpos($pais['pais'], ' ') !== false;

$nomeDePaisesEmMaiusculo = fn(Maybe $dados) => Maybe::of(array_map('convertePaisParaLetraMaiuscula', $dados->getOrElse([])));
$filtraPaisesSemEspacoNoNome = fn(Maybe $dados) => Maybe::of(array_filter($dados->getOrElse([]), $verificaSePaisTemEspacoNoNome));

$funcoes = pipeline($filtraPaisesSemEspacoNoNome, $nomeDePaisesEmMaiusculo);
$dados = $funcoes($dados);

var_dump($dados->getOrElse([]));

