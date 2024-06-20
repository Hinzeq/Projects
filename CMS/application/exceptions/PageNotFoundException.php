<?php

declare(strict_types=1);

class PageNotFoundException extends Exception
{
    public function __construct()
    {
        echo 'Page not found!';
        exit;
    }
}
