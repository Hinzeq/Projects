<?php

checkPesel(
    is_numeric($_POST['pesel'])
        ? $_POST['pesel']
        : null
);

function checkPesel(?int $pesel) {
    if (!$pesel) {
        throw new Exception('error');
    }
    dd($pesel);
}