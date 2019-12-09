<?php

function solve($memberNum, $relationNum, $relations)
{
    if ($relationNum === 0) return 1;

    $memberRelations = [];

    foreach ($relations as $relation) {
        $memberRelations[$relation[0]][] = $relation[1];
        $memberRelations[$relation[1]][] = $relation[0];
    }

    $relCount = [];
    foreach ($memberRelations as $n => $rel) {
        $relCount[$n] = count($rel);
    }
    asort($relCount);

    for ($i = max($relCount); $i > 0; $i--) {
        $targets = array_filter($relCount, function ($val) use ($i) { return $val >= $i; });
        // 同じ知り合い数の人が同数いないとどう頑張ってもできない
        if (count($targets) < $i) continue;
        if (canMakeFaction($i, $targets, $memberRelations)) return $i + 1;
    }
}

function canMakeFaction($num, $targetRels, $memberRelations)
{
    if ($num > count($targetRels)) return false;
    // TODO
    return false;
}

function main()
{
    $nums = explode(' ', trim(fgets(STDIN)));

    $relations = [];
    for ($i = 0; $i < $nums[1]; $i++) {
        $relations[] = explode(' ', trim(fgets(STDIN)));
    }

    echo solve($nums[0], $nums[1], $relations) . PHP_EOL;
}

// main();

echo solve(5, 3, [
        [1, 2],
        [2, 3],
        [1, 3],
    ]) . PHP_EOL;
echo solve(5, 3, [
        [1, 2],
        [2, 3],
        [3, 4],
    ]) . PHP_EOL;
echo solve(7, 9, [
        [1, 2],
        [1, 3],
        [2, 3],
        [4, 5],
        [4, 6],
        [4, 7],
        [5, 6],
        [5, 7],
        [6, 7],
    ]) . PHP_EOL;
echo solve(12, 0, []) . PHP_EOL;
