<?php

namespace Project;

use Exception;

class ContentGenerator
{
    public static function generateContent(?array $content)
    {
        $i = 0;
        $newFileText = [];
        foreach ($content as $singleLine) {
            foreach ($singleLine as $singleWord) {
                $newLine = false;
                if (strstr($singleWord, PHP_EOL)) {
                    $singleWord = str_replace(PHP_EOL, "", $singleWord);
                    $newLine = true;
                }
        
                // check if last char is punctuation
                $punctuation = ctype_punct(substr($singleWord, -1))
                    ? substr($singleWord, -1)
                    : null;
        
                // get middle part of word without punctuation
                $midWord = mb_str_split(
                    mb_substr(
                        $singleWord, 
                        1, 
                        $punctuation ? -2 : -1
                    )
                );
        
                shuffle($midWord);
                
                if (!isset($singleWord[0])) {
                    $newWord = "\n";
                } else {
                    $newWord = $singleWord[0]
                        . implode("", $midWord)
                        . mb_substr($singleWord, $punctuation ? -2 : -1) 
                        . ($newLine ? "\n" : '');
                }
                
                $newFileText[$i][] = $newWord;
            }
            $i++;
        }
        return $newFileText;
    }
}
