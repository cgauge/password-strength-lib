<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Digit;
use CustomerGauge\Password\Exception\InvalidPassword;

class DigitTest extends TestCase
{
    public function test_it_can_validate_at_least_one_digit()
    {
        self::expectException(InvalidPassword::class);

        $digit = new Digit(); 

        $digit('password');
    }

    public function test_it_can_validate_at_least_two_digits()
    {
        self::expectException(InvalidPassword::class);

        $digit = new Digit(2); 

        $digit('Password1!');
    }
}
