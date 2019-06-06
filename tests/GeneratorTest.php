<?php

namespace Tests\CustomerGauge\Password;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\RuleChain;
use CustomerGauge\Password\Generator;

class GeneratorTest extends TestCase
{
    public function test_it_can_generate_valid_passwords_based_on_rules()
    {
        $rules = new RuleChain(function(){}); 
        
        $passwordGenerator = new Generator($rules);

        self::assertIsString($passwordGenerator());
    }
}
