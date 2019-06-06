<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Length;
use CustomerGauge\Password\Exception\InvalidPassword;

class LengthTest extends TestCase
{
    public function test_it_can_validate_min_length()
    {
        self::expectException(InvalidPassword::class);

        $length = new Length(10);

        $length('sõês é~i!');
    }

    public function test_it_can_validate_max_length()
    {
        self::expectException(InvalidPassword::class);

        $length = new Length(1, 6);

        $length('õês é~!');
    }
}
