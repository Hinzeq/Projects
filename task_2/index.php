<?php

require './config/require.php';

if (isset($_POST['pesel'])) {
    try {
        $pesel = require './validation.php';
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

require './view.php';
