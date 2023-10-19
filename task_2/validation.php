<?php

return checkPesel(
    is_numeric($_POST['pesel'])
        ? $_POST['pesel']
        : null
);

function checkPesel(?int $pesel) : bool 
{
    if (!$pesel) {
        throw new Exception('Is not numeric.');
    } elseif (strlen($pesel) !== 11) {
        throw new Exception('The length of the PESEL number must be 11 characters.');
    }
    

    $weightNumbersPosition = [ 1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
    $peselArray = checkMonthAndDay(str_split($pesel));
    $sum = 0;

    for ($i = 0; $i < 10; $i++) {
        $sum += 
            $peselArray[$i] 
            * $weightNumbersPosition[$i];
    }

    return $peselArray[10] == 10 - $sum % 10;
}

function checkMonthAndDay(array $pesel) : array
{
    if (
        $pesel[2] > 3
        || (
            ($pesel[2] == 1 || $pesel[2] == 3)
            && $pesel[3] > 2
        )
        || ($pesel[2] == 0 && $pesel[3] == 0)
    ) {
        throw new Exception('Incorrect month number.');
    } elseif (
        $pesel[4] > 3
        || ($pesel[4] == 0 && $pesel[5] == 0)
    ) {
        throw new Exception('Incorrect day number.');
    }

    return $pesel;
}