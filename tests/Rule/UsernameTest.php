<?php

declare(strict_types=1);

/*
    Password Strength Library
    Copyright (C) 2019 CustomerGauge
    foss@customergauge.com

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU Lesser General Public
    License as published by the Free Software Foundation; either
    version 3 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with this program; if not, write to the Free Software Foundation,
    Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

namespace Tests\CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\InvalidPassword;
use CustomerGauge\Password\Rule\Username;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    #[DataProvider('usernames')]
    public function testItCanValidateAUsername(string $password, string $username): void
    {
        $this->expectException(InvalidPassword::class);

        $blacklist = new Username([$username]);

        $blacklist($password);
    }

    public static function usernames(): mixed
    {
        return [
            'Same username' => ['username', 'username'],
            'Inicial username part' => ['user123', 'username'],
        ];
    }
}
