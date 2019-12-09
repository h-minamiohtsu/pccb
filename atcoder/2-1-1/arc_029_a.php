<?php

function solve($meatCount, $meatTimes) {
    if ($meatCount === 1) return array_pop($meatTimes);

    $midTime = array_sum($meatTimes) / 2;

    $checkMeatNum = ceil($meatCount / 2);

    $timeLags = [];
    for ($i = 1; $i <= $checkMeatNum; $i++) {
        $timeLags[] = minMidTimeLag(0, $meatTimes, $i, $midTime);

    }
    return min($timeLags) + $midTime;
}

function minMidTimeLag($sum, $meatTimes, $count, $midTime) {
    if ($count === 0) {
        return abs($sum - $midTime);
    }
    if (count($meatTimes) === $count) {
        return abs($sum + array_sum($meatTimes) - $midTime);
    }
    $currentTime = array_pop($meatTimes);

    return min(
        minMidTimeLag($sum + $currentTime, $meatTimes, $count - 1, $midTime),
        minMidTimeLag($sum, $meatTimes, $count, $midTime)
    );
}

function main() {
    $meatCount = intval(trim(fgets(STDIN)));

    $meatTimes = [];
    for ($i = 0; $i < $meatCount; $i++) {
        $meatTimes[] = intval(trim(fgets(STDIN)));
    }

    echo solve($meatCount, $meatTimes) . PHP_EOL;
}

main();

//echo solve(3, [3, 1, 2, 4]) . PHP_EOL;
//echo solve(1, [29]) . PHP_EOL;
