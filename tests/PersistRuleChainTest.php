<?php

namespace Tests\CustomerGauge\Password;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule;
use CustomerGauge\Password\PersistRuleChain;
use CustomerGauge\Password\Exception\InvalidPassword;

class PersistRuleChainTest extends TestCase
{
    public function test_it_can_validate_rules()
    {
        $rule = $this->createMock(Rule::class);

        $rule->expects($this->once())
            ->method('__invoke');

        $validate = new PersistRuleChain($rule);

        self::assertTrue($validate('password'));
    }

    public function test_it_returns_false_when_there_is_an_exception()
    {
        $rule = $this->createMock(Rule::class);

        $rule->method('__invoke')
            ->will($this->throwException(new InvalidPassword));

        $validate = new PersistRuleChain($rule);

        self::assertFalse($validate('password'));
    }
}
