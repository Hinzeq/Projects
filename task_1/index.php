<?php

function dd($value, $die = null) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    if($die === null) 
        die();
}

$file = fopen("text.txt", "r");
$fileText = [];

while ($line = fgets($file)) {
    $fileText[] = explode(" ", $line);
}
fclose($file);

$i = 0;
$newFileText = [];

foreach($fileText as $singleLine) {
    foreach($singleLine as $singleWord) {
        $newLine = false;
        if(strstr($singleWord, PHP_EOL)) {
            $singleWord = str_replace(PHP_EOL, "", $singleWord);
            $newLine = true;
        }
        
        // check if last char is punctuation
        $punctuation = ctype_punct(substr($singleWord, -1))
                ? substr($singleWord, -1)
                : null;

        // get middle part of word without punctuation
        $midWord = str_split(
            substr(
                $singleWord, 
                1, 
                $punctuation ? -2 : -1
            )
        );
        shuffle($midWord);

        $newWord = $newLine 
            ? "\n" 
            : $singleWord[0] 
                . implode("", $midWord) 
                . substr($singleWord, $punctuation ? -2 : -1);
        $newFileText[$i][] = $newWord;
    }
    $i++;
}

$newFile = fopen("text_copy.txt", "w");

foreach($newFileText as $newSingleLine)
    fwrite(
        $newFile,
        implode(" ", $newSingleLine)
    );

fclose($newFile);
