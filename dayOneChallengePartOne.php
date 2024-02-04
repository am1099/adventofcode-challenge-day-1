<?php

$filePath = 'puzzleInput.txt';

if (!file_exists($filePath)) {
    die("File not found: $filePath\n");
}

$fileContents = file_get_contents($filePath);
$calibrationStrings = preg_split('/\s+/', $fileContents, -1, PREG_SPLIT_NO_EMPTY);

$sumOfCalibrationValues = 0;

foreach ($calibrationStrings as $string) {
    $numericCharacters = preg_replace("/[^0-9]/", "", $string);

    if (!empty($numericCharacters)) {
        $firstValue = $numericCharacters[0];
        $lastValue = substr($numericCharacters, -1);

        $sumOfCalibrationValues += intval($firstValue . $lastValue);
    }
}

echo $sumOfCalibrationValues;
