<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Lowercase;
use CustomerGauge\Password\Exception\InvalidPassword;

class LowercaseTest extends TestCase
{
    public function test_it_can_validate_at_least_one_lowercase_letter()
    {
        self::expectException(InvalidPassword::class);

        $lowercase = new Lowercase(); 

        $lowercase('PASSWORD');
    }

    public function test_it_can_validate_at_least_two_lowercase_letters()
    {
        self::expectException(InvalidPassword::class);

        $lowercase = new Lowercase(2); 

        $lowercase('PASSWORd!');
    }
}
