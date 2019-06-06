<?php

namespace Tests\CustomerGauge\Password;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule;
use CustomerGauge\Password\RuleChain;

class RuleChainTest extends TestCase
{
    public function test_it_can_validate_all_rules()
    {
        $function = function() {};

        $customMethod = new FixtureCustomMethod;

        $rule = $this->createMock(Rule::class);

        $rule->expects($this->once())
            ->method('__invoke');

        $validate = new RuleChain(
            'is_string',
            $function,
            $rule,
            [$customMethod, 'customMethod']
        );

        $validate('password');
    }
}

class FixtureCustomMethod
{
    public function customMethod(string $value) : void
    {
    }
}
