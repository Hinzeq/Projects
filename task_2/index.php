<?php

use Project\Validator;

require './config/require.php';

if (isset($_POST['pesel'])) {
    try {
        $peselValidator = new Validator($_POST['pesel']);
        $pesel = $peselValidator->validate();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

require './view.php';
