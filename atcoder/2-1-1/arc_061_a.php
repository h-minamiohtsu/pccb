<?php

function solve($value) {
    $numbers = str_split($value);
    $count = count($numbers);

    for ($i = 1; $i < $count; $i++) {
        array_splice($numbers, $i * 2 - 1, 0, '');
    }

    return calcTotal($numbers, 1);
}

function calc($formulaData) {
    return array_sum(explode('+', implode($formulaData)));
}

function calcTotal($formulaData, $i) {
    if ($i >= count($formulaData)) return calc($formulaData);

    $withoutPlus = calcTotal($formulaData, $i + 2);
    $formulaData[$i] = '+';
    $withPlus = calcTotal($formulaData, $i + 2);

    return $withoutPlus + $withPlus;
}

echo solve('125') . "\n";
echo solve('9999999999') . "\n";
