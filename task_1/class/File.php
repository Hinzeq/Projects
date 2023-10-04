<?php

namespace Project;

use Exception;

class File
{
    public static function loadContent(?string $fileName): array
    {
        if (is_null($fileName)) {
            throw new Exception('File not found.');
        }
        elseif (!file_exists($fileName)) {
            throw new Exception("File not found: {$fileName}");
        } else {
            $file = fopen($fileName, 'r');
            while ($line = fgets($file)) {
                $fileText[] = explode(' ', $line);
            }
            fclose($file);

            if (!isset($fileText)) {
                throw new Exception('The content of the copied file cannot be empty.');
            }

            return $fileText;
        }
    }

    public static function saveContent(?string $fileName, array $fileText): void
    {
        if (is_null($fileName)) {
            throw new Exception('File to save not found.');
        } else {
            $file = fopen($fileName, 'w');
            foreach ($fileText as $singleLine) {
                fwrite(
                    $file,
                    implode(' ', $singleLine)
                );
            }
            fclose($file);
        }
        
    }
}
