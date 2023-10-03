<?php

namespace Project;

class File
{
    public static function loadContent(string $fileName)
    {
        $file = fopen($fileName, "r");
        while ($line = fgets($file)) {
            $fileText[] = explode(" ", $line);
        }
        fclose($file);
        return $fileText;
    }

    public static function saveContent(string $fileName, array $fileText)
    {
        $file = fopen($fileName, "w");
        foreach ($fileText as $singleLine) {
            fwrite(
                $file,
                implode(" ", $singleLine)
            );
        }
        fclose($file);
    }
}
