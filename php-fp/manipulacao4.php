<?php

require_once 'vendor/autoload.php';

use function igorw\pipeline;

$dados = require 'dados.php';

function convertePaisParaLetraMaiuscula(array $pais)
{
  $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
  return $pais;
}

$verificaSePaisTemEspacoNoNome = fn (array $pais): bool => strpos($pais['pais'], ' ') !== false;

$nomeDePaisesEmMaiusculo = fn($dados) => array_map('convertePaisParaLetraMaiuscula', $dados);
$filtraPaisesSemEspacoNoNome = fn($dados) => array_filter($dados, $verificaSePaisTemEspacoNoNome);

$funcoes = pipeline($filtraPaisesSemEspacoNoNome, $nomeDePaisesEmMaiusculo);
$dados = $funcoes($dados);

var_dump($dados);

