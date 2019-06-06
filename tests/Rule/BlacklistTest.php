<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Blacklist;
use CustomerGauge\Password\Exception\InvalidPassword;

class BlacklistTest extends TestCase
{
    public function test_it_can_validate_a_blacklist()
    {
        self::expectException(InvalidPassword::class);

        $password  = 'blackliststring';
        $blacklist = new Blacklist([$password]); 

        $blacklist($password);
    }
}
