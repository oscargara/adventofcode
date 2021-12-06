<?php

$handle = fopen("day-3.sample", "r");
if ($handle) {
    $totalLines = 0;
    $countOnes = [];
    while (($line = fgets($handle)) !== false) {
        $i = 0;
        $current = $line[$i] ?? null;
        while ($current !== null && $current !== "\n") {
            $countOnes[$i] = ($countOnes[$i] ?? 0) + (int)$current;
            $current = $line[++$i] ?? null;
        }
        ++$totalLines;
        calculate($countOnes, $totalLines);
    }
    fclose($handle);
} else {
    // error opening the file.
}

function calculate($countOnes, $totalLines)
{
    $gamma = '';
    $epsilon = '';
    foreach ($countOnes as $ones) {
        $gamma .=  2 * $ones > $totalLines ? "1" : "0";
        $epsilon .=  2 * $ones > $totalLines ? "0" : "1";
    }

    echo (base_convert($gamma, 2, 10) * base_convert($epsilon, 2, 10)) . PHP_EOL;
}
