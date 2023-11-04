<?php

use PHPUnit\Framework\TestCase;
use Project\Validator;
use Exception;

class ValidatorTest extends TestCase
{
    public function testValidPesel()
    {
        $this->assertTrue((new Validator('02070803628'))->validate());
    }

    public function testInvalidPesel()
    {
        $this->assertFalse((new Validator('44051401358'))->validate());
    }

    public function testExceptionPeselIsNumeric()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Is not numeric.');

        $this->assertTrue((new Validator('1111b111111'))->validate());
    }

    public function testExceptionPeselIsNotHaveElevenCharacters()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The length of the PESEL number must be 11 characters.');

        $this->assertTrue((new Validator('1111'))->validate());
    }

    public function testExceptionIncorrectMonthNumber()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Incorrect month number.');

        $this->assertTrue((new Validator('11131111111'))->validate());
    }

    public function testExceptionIncorrectDayNumber()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Incorrect day number.');

        $this->assertTrue((new Validator('11110011111'))->validate());
    }
}
