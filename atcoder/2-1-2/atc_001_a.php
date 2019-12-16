<?php

const START = 's';
const GOAL = 'g';
const KABE = '#';
const ROAD = '.';

$checkedMap = [];
$searchMap = [];

function solve($height, $width)
{
    global $searchMap;

    $startX = 0;
    $startY = 0;

    foreach ($searchMap as $y => $line) {
        if (($x = array_search(START, $line, true)) !== false) {
            $startY = $y;
            $startX = $x;
            break;
        }
    }

    return isReachableGoal($startX, $startY) ? 'Yes' : 'No';
}

function isReachableGoal($x, $y)
{
    global $searchMap, $checkedMap;

    if (!isset($searchMap[$y][$x])
        || isset($checkedMap[$y][$x])
        || $searchMap[$y][$x] === KABE) return false;

    if ($searchMap[$y][$x] === GOAL) return true;

    $checkedMap[$y][$x] = 1;

    return isReachableGoal($x - 1, $y)
        || isReachableGoal($x + 1, $y)
        || isReachableGoal($x, $y - 1)
        || isReachableGoal($x, $y + 1);
}

function main()
{
    global $searchMap;

    $nums = explode(' ', trim(fgets(STDIN)));

    for ($i = 0; $i < $nums[0]; $i++) {
        $searchMap[] = str_split(trim(fgets(STDIN)));
    }

    echo solve($nums[0], $nums[1]) . PHP_EOL;
}

main();

