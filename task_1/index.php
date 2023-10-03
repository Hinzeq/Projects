<?php

use Project\File;
use Project\ContentGenerator;

require './config/require.php';

File::saveContent(
    $config['newFileName'],
    ContentGenerator::generateContent(
        File::loadContent($config['fileName'])
    )
);
