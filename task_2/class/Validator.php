<?php

namespace Project;

use Exception;

class Validator
{

    private array $peselArray;

    public function __construct(
        private $pesel
    ){
        $this->peselArray = str_split($this->pesel);
    }

    public function validate(): bool
    {
        return $this->checkPesel(
            is_numeric($this->pesel)
                ? $this->pesel
                : null
        );
    }

    private function checkPesel(): bool
    {
        if (!$this->pesel) {
            throw new Exception('Is not numeric.');
        } elseif (strlen($this->pesel) !== 11) {
            throw new Exception('The length of the PESEL number must be 11 characters.');
        }

        $weightNumbersPosition = [ 1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $this->checkMonthAndDay();
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += 
                $this->peselArray[$i] 
                * $weightNumbersPosition[$i];
        }

        return $this->peselArray[10] == 10 - $sum % 10;
    }

    private function checkMonthAndDay(): void
    {
        if (
            $this->peselArray[2] > 3
            || (
                ($this->peselArray[2] == 1 || $this->peselArray[2] == 3)
                && $this->peselArray[3] > 2
            )
            || ($this->peselArray[2] == 0 && $this->peselArray[3] == 0)
        ) {
            throw new Exception('Incorrect month number.');
        } elseif (
            $this->peselArray[4] > 3
            || ($this->peselArray[4] == 0 && $this->peselArray[5] == 0)
        ) {
            throw new Exception('Incorrect day number.');
        }
    }

}
