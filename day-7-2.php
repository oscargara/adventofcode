<?php

$handle = fopen("day-7.sample", "r");
if ($handle) {
    $totalLines = 0;
    $countOnes = [];
    $crabsPos = [];
    $pos = '';
    while (false !== ($char = fgetc($handle))) {
        $char = trim($char);
        if ($char === ',') {
            $crabsPos[] = $pos;
            $pos = '';
            continue;
        }
        $pos .= $char;
    }
    $crabsPos[] = $pos;
    fclose($handle);
} else {
    // error opening the file.
}

forceBrute($crabsPos);


function forceBrute($list)
{
    $minEnergy = null;
    $minPivot = 0;
    $limitPivot = 1;
    $pivot = 1;
    $totalEnergy = 0;
    while ($pivot <= $limitPivot) {
        $iterations = 0;
        foreach ($list as $pos) {
            $totalEnergy += calculateEnergy($pos, $pivot);
            if ($pos > $limitPivot) $limitPivot = $pos;
            if ($minEnergy && $totalEnergy >= $minEnergy) break;
            ++$iterations;
        }
        if (!$minEnergy || $totalEnergy < $minEnergy) {
            $minEnergy = $totalEnergy;
            $minPivot = $pivot;
        }
        echo "iterations: " . $iterations. ", current pivot: ". $pivot . ', Minimal energy: ' . $minEnergy .' =>  Minimal pivot: '.  $minPivot. PHP_EOL;
        $totalEnergy = 0;
        ++$pivot;
    }
}

function calculateEnergy($pos, $pivot)
{
    $a = abs($pos - $pivot);
    return ($a/2)*($a+1);
}