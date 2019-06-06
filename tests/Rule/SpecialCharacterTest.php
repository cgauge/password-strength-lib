<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\SpecialCharacter;
use CustomerGauge\Password\Exception\InvalidPassword;

class SpecialCharacterTest extends TestCase
{
    public function test_it_can_validate_at_least_one_special_letter()
    {
        self::expectException(InvalidPassword::class);

        $special = new SpecialCharacter(); 

        $special('nospecial');
    }

    public function test_it_can_validate_at_least_two_special_letters()
    {
        self::expectException(InvalidPassword::class);

        $special = new SpecialCharacter(2); 

        $special('onespecial!');
    }
}
