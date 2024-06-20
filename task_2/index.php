<?php

use Project\Validator;

require './config/require.php';

if (isset($_POST['pesel'])) {
    try {
        $pesel = (new Validator($_POST['pesel']))->validate();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

require './view.php';
