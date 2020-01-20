<?php

function solve($string)
{
    return countUpTape($string, 0);
}

function countUpTape($string, $num) {
    $kyotoPos = strpos($string, 'kyoto');
    $tokyoPos = strpos($string, 'tokyo');
    $containKyoto = $kyotoPos !== false;
    $containTokyo = $tokyoPos !== false;

    if ($containKyoto && $containTokyo) {
        return countUpTape(substr($string, min($kyotoPos, $tokyoPos) + 5), ++$num);
    } elseif ($containKyoto) {
        return $num + substr_count($string, 'kyoto');
    } elseif ($containTokyo) {
        return $num + substr_count($string, 'tokyo');
    } else {
        return $num;
    }
}

function main()
{
    $number = trim(fgets(STDIN));

    for ($i = 0; $i < $number; $i++) {
        echo solve(trim(fgets(STDIN))) . PHP_EOL;
    }
}

main();

