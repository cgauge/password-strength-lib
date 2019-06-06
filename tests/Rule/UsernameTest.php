<?php

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Username;
use CustomerGauge\Password\Exception\InvalidPassword;

class UsernameTest extends TestCase
{
    /**
     * @dataProvider usernames
     */
    public function test_it_can_validate_a_username($password, $username)
    {
        self::expectException(InvalidPassword::class);

        $blacklist = new Username([$username]); 

        $blacklist($password);
    }

    public function usernames()
    {
        return [
            'Same username' => ['username', 'username'],
            'Inicial username part' => ['user123', 'username'],
        ];
    }
}
