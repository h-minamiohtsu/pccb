<?php

const SEA = 'x';
const ISLAND = 'o';

$searchMap = [];

function solve($bitMap)
{
    global $searchMap;

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
            if ($bitMap[$i] & (1 << $j)) continue;

            $searchMap = $bitMap;
            $searchMap[$i] += 1 << $j;
            makeSearchMap($i, $j);
            if (hasOnlySea()) return 'YES';
        }
    }

    return 'NO';
}

function makeSearchMap($i, $j)
{
    global $searchMap;

    if ($i < 0 || $i > 9 || $j < 0 || $j > 9 || (~$searchMap[$i] & 1 << $j)) return;

    $searchMap[$i] -= 1 << $j;

    makeSearchMap($i - 1, $j);
    makeSearchMap($i + 1, $j);
    makeSearchMap($i, $j - 1);
    makeSearchMap($i, $j + 1);

    return;
}

function hasOnlySea()
{
    global $searchMap;
    foreach ($searchMap as $line) {
        if ($line !== 0) return false;
    }
    return true;
}

function main()
{
    $bitMap = [];
    for ($i = 0; $i < 10; $i++) {
        $bitMap[] = 0;
        $map = str_split(trim(fgets(STDIN)));
        foreach ($map as $j => $symbol) {
            if ($symbol === ISLAND) {
                $bitMap[$i] += 1 << $j;
            }
        }
    }

    echo solve($bitMap) . PHP_EOL;
}

main();

