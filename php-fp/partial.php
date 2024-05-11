<?php

function dividir($a, $b)
{
  return $a / $b;
}

function dividirPor($divisor)
{
  return function ($numero) use ($divisor) {
    return dividir($numero, $divisor);
  };
}

$dividirPor2 = dividirPor(2);

echo $dividirPor2(4) . PHP_EOL;
echo $dividirPor2(5) . PHP_EOL;
echo $dividirPor2(10) . PHP_EOL;
