<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Uppercase;
use CustomerGauge\Password\Exception\InvalidPassword;

class UppercaseTest extends TestCase
{
    public function test_it_can_validate_at_least_one_uppercase_letter()
    {
        self::expectException(InvalidPassword::class);

        $uppercase = new Uppercase(); 

        $uppercase('password');
    }

    public function test_it_can_validate_at_least_two_uppercase_letters()
    {
        self::expectException(InvalidPassword::class);

        $uppercase = new Uppercase(2); 

        $uppercase('Password!');
    }
}
