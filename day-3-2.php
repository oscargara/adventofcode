<?php

$handle = fopen("day-3.sample", "r");
if ($handle) {
    $list = [];
    while (($line = fgets($handle)) !== false) {
        $list[] = trim($line);
    }
    fclose($handle);
} else {
    // error opening the file.
}


$positionBit = 0;
[$oxygen, $co2] = reduce($list, $positionBit);
while (true) {
    // print_r($oxygen);
    $lastOxygen = $oxygen;
    [$oxygen] = reduce($oxygen, ++$positionBit);
    if ($oxygen === null || count($oxygen) === 0) break;
}
echo "Oxygen: " . $lastOxygen[0] . PHP_EOL;


$positionBit = 0;
while (true) {
    // print_r($co2);
    $lastCo2 = $co2;
    [, $co2] = reduce($co2, ++$positionBit);
    if ($co2 === null || count($co2) === 0) break;
}
echo "CO2: " . $lastCo2[0] . PHP_EOL;

$lifeSupportRating = (base_convert($lastOxygen[0], 2, 10) * base_convert($lastCo2[0], 2, 10));
echo "Result: " . $lifeSupportRating . PHP_EOL;

function reduce(array $list, int $positionBit)
{
    $totalLines = 0;
    $countOnes = 0;
    $startOnes = [];
    $startZeros = [];
    foreach ($list as $l) {
        if (!isset($l[$positionBit])) return [null, null];
        $current = (int)$l[$positionBit];
        $countOnes += $current;
        if ($current == 1) $startOnes[] = $l;
        else $startZeros[] = $l;
        ++$totalLines;
    }

    return (2 * $countOnes >= $totalLines) ? [$startOnes, $startZeros] : [$startZeros, $startOnes];
}
