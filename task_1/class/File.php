<?php

namespace Project;

use Exception;

class File
{
    public static function loadContent(string $fileName)
    {
        if (!file_exists($fileName)) {
            throw new Exception("File not found: {$fileName}");
        } else {
            $file = fopen($fileName, "r");
            while ($line = fgets($file)) {
                $fileText[] = explode(" ", $line);
            }
            fclose($file);

            if (!isset($fileText)) {
                throw new Exception("The content of the copied file cannot be empty.");
            }

            return $fileText;
        }
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
