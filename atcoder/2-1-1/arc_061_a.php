<?php

function solve($value) {
    $numbers = str_split($value);
    $formulaData = [];
    foreach ($numbers as $key => $val) {
        if ($key !== 0) $formulaData[] = '';
        $formulaData[] = $val;
    }
    echo calcTotal($formulaData, 1, 0) . "\n";
}
function calc($formulaData) {
    return array_sum(explode('+', implode($formulaData)));
}
function calcTotal($formulaData, $i, $total) {
    if ($i >= count($formulaData)) return $total + calc($formulaData);

    $total = calcTotal($formulaData, $i + 2, $total);
    $formulaData[$i] = '+';
    $total = calcTotal($formulaData, $i + 2, $total);
    return $total;
}

solve('125');
solve('999999999');
