<?php

$filePath = 'puzzleInput.txt';

if (!file_exists($filePath)) {
    die("File not found: $filePath\n");
}

$fileContents = file_get_contents($filePath);
$calibrationStrings = preg_split('/\s+/', $fileContents, -1, PREG_SPLIT_NO_EMPTY);

$numberDictionary = [
    [1 => 'one'],
    [2 => 'two'],
    [3 => 'three'],
    [4 => 'four'],
    [5 => 'five'],
    [6 => 'six'],
    [7 => 'seven'],
    [8 => 'eight'],
    [9 => 'nine'],
];

$sumOfCalibrationValues = 0;

foreach ($calibrationStrings as $string) {
    // Convert the spelled out numbers into numbers
    for ($i = 0; $i <= strlen($string) - 1; $i++) {

        for ($j = 0; $j <= count($numberDictionary) - 1; $j++) {

            $numberWording = array_values($numberDictionary[$j])[0];
            if (isset($string[$i]) && $string[$i] == $numberWording[0]) {
                $lettersToCheck = strlen($numberWording);
                if (substr($string, $i, $lettersToCheck) == $numberWording) {
                    // change the first letter of the word number to its actual number. 
                    // Not changing the whole word with its number to cover cases like sevenine so it outputs 7eve9ine instead of 7ine
                    $string = substr_replace($string, array_keys($numberDictionary[$j])[0], $i, 1);
                }
            }
        }
    }


    // Only keep numbers so its easier to pick the first and last number
    $numericCharacters = preg_replace("/[^0-9]/", "", $string);

    if (!empty($numericCharacters)) {
        $firstValue = $numericCharacters[0];
        $lastValue = substr($numericCharacters, -1);
        $sumOfCalibrationValues += intval($firstValue . $lastValue);
    }
}

echo "The Sum Of All Of The Calibration Values Are: " . $sumOfCalibrationValues;
