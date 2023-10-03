<?php

use Project\File;
use Project\ContentGenerator;

require './config/require.php';

try {
    File::saveContent(
        $config['newFileName'],
        ContentGenerator::generateContent(
            File::loadContent($config['fileName'])
        )
    );
    echo "Poprawnie zapisano plik {$config['newFileName']}";
} catch (Exception $e) {
    die($e->getMessage());
}
