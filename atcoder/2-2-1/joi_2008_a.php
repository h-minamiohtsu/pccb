<?php

function solve($payment)
{
    $change = 1000 - $payment;

    return countUpChangeCoin($change, 0, [500, 100, 50, 10, 5, 1]);
}

function countUpChangeCoin($change, $coinCount, $coinValues)
{
    if ($change == 0) return $coinCount;

    $coinValue = array_shift($coinValues);

    $num = floor($change / $coinValue);

    return countUpChangeCoin($change - $coinValue * $num, $coinCount + $num, $coinValues);

}

function main()
{
    $payment = trim(fgets(STDIN));

    echo solve($payment) . PHP_EOL;
}

main();

