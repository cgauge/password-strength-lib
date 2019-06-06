<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\SequencialNumber;
use CustomerGauge\Password\Exception\InvalidPassword;

class SequencialNumberTest extends TestCase
{
    public function test_it_can_validate_sequencial_numbers()
    {
        self::expectException(InvalidPassword::class);

        $sequencial = new SequencialNumber; 

        $sequencial('password123');
    }

    public function test_it_can_validate_sequencial_numbers_decreasing()
    {
        self::expectException(InvalidPassword::class);

        $sequencial = new SequencialNumber; 

        $sequencial('password321');
    }
}
