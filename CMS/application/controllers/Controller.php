<?php

declare(strict_types=1);

class Controller
{
    public static function blogs()
    {
        return 'Here is blogs!';
    }

    public static function blog($id)
    {
        return "Blog with post id {$id}!";
    }

    public static function test($id, $test)
    {
        return "Blog with post id {$id}! This is a test {$test}";
    }
}
