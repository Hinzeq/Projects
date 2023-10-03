<?php

namespace Project;

use Exception;

class File
{
    public static function loadContent(string $fileName)
    {
        if (!file_exists($fileName)) {
            throw new Exception("Błąd podczas odczytu, nie znaleziono pliku: {$fileName}");
        } else {
            $file = fopen($fileName, "r");
            while ($line = fgets($file)) {
                $fileText[] = explode(" ", $line);
            }
            fclose($file);

            if (!isset($fileText)) {
                throw new Exception("Zawartość kopiowanego pliku nie może być pusta");
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
