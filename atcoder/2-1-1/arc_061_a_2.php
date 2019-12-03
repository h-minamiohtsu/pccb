<?php

function solve($value) {
    $numbers = str_split($value);
    return calcTotal($numbers);
}

function calcTotal($numbers) {
    $count = count($numbers);

    if ($count === 1) return (int) array_pop($numbers);

    $total = implode($numbers);
    for ($i = 1; $i < $count; $i++) {
        $num = (int) implode(array_slice($numbers, 0, $i));
        $total += $num * (2 ** ($count - $i - 1)) + calcTotal(array_slice($numbers, $i));
    }
    return $total;
}

echo solve('125') . "\n";
echo solve('9999999999') . "\n";

