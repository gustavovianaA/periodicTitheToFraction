<?php
include_once('Fraction.php');
include_once('Operation.php');
include_once('constants.php');

$number1 = $argv[1] ?? null;
$operation = $argv[2] ?? null;
$number2 = $argv[3] ?? null;

function compute($number){
    $fraction = new Fraction($number);
    $fraction->decimalToFraction();
    $equality = $computing1 = '<br> $$' . $number . '\cdots =  \frac{' . $fraction->getP() . '}{' . $fraction->getQ() . '} $$ <br>';
    return ['fraction' => $fraction,
            'latexFraction' => $fraction->latexFraction(),
            'equality' => $equality];
}

$n1 = compute($number1);
$n2 = compute($number2);
$result =  new Operation($operation , $n1['fraction'] , $n2['fraction']);
$resultingFraction = $result->sum();

print_r($resultingFraction);

$computingExpression = '$$' . $number1 . $operation . $number2 . ' = ' . $n1['latexFraction'] . ' + ' . $n2['latexFraction'] . ' = ' . $resultingFraction->latexFraction() . ' $$'; 

$interfaceFile = fopen('computations.html', 'w');
fwrite($interfaceFile, MATHJAX . $n1['equality'] . $n2['equality'] . $computingExpression);
fclose($interfaceFile);

exec("firefox computations.html");


