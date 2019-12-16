<?php

const SEA = 'x';
const ISLAND = 'o';

$searchMap = [];

function solve($map)
{
    global $searchMap;

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
            if ($map[$i][$j] === ISLAND
                || !isAdjacentIsland($i, $j, $map)) continue;

            $searchMap = $map;
            $searchMap[$i][$j] = ISLAND;
            makeSearchMap($i, $j);
            if (hasOnlySea()) return 'YES';
        }
    }

    return 'NO';
}

function isAdjacentIsland($i, $j, $map)
{
    return (isset($map[$i - 1][$j]) && $map[$i - 1][$j] === ISLAND)
        || (isset($map[$i + 1][$j]) && $map[$i + 1][$j] === ISLAND)
        || (isset($map[$i][$j - 1]) && $map[$i][$j - 1] === ISLAND)
        || (isset($map[$i][$j + 1]) && $map[$i][$j + 1] === ISLAND);
}

function makeSearchMap($i, $j)
{
    global $searchMap;

    if (!isset($searchMap[$i][$j]) || $searchMap[$i][$j] === SEA) return;

    $searchMap[$i][$j] = SEA;

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
        if (in_array(ISLAND, $line, true)) return false;
    }
    return true;
}

function main()
{
    $map = [];
    for ($i = 0; $i < 10; $i++) {
        $map[] = str_split(trim(fgets(STDIN)));
    }

    echo solve($map) . PHP_EOL;
}

main();

