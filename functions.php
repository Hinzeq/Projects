<?php

function dd($value, $die = null) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    if($die === null) 
        die();
}
