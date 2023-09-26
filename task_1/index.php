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
// dd($fileText[3]);
foreach($fileText as $singleLine) {
    // dd($singleLine,1);
    foreach($singleLine as $singleWord) {
        // dd($singleWord,1);
        $newLine = false;
        if(strstr($singleWord, PHP_EOL)) {
            $singleWord = str_replace(PHP_EOL, "", $singleWord);
            $newLine = true;
        }
        
        // check if last char is punctuation
        $punctuation = ctype_punct(substr($singleWord, -1))
                ? substr($singleWord, -1)
                : null;


        dd(
            mb_str_split(
                mb_substr(
                    $singleWord, 
                    1, 
                    $punctuation ? -2 : -1
                )
            )
            ,1
        );


        // get middle part of word without punctuation
        $midWord = mb_str_split(
            mb_substr(
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
                . mb_substr($singleWord, $punctuation ? -2 : -1);
        // dd(
        //     $newWord,1
        // );
        $newFileText[$i][] = $newWord;
    }
    $i++;
}

// dd(
//     $newFileText
// );

$newFile = fopen("text_copy.txt", "w");
// fwrite($newFile, pack("CCC", 0xef, 0xbb, 0xbf));

foreach($newFileText as $newSingleLine)
    fwrite(
        $newFile,
        implode(" ", $newSingleLine)
    );

// file_put_contents($newFile, "\xEF\xBB\xBF".  $content); 
fclose($newFile);
