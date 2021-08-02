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
use CustomerGauge\Password\Rule\Lowercase;
use PHPUnit\Framework\TestCase;

class LowercaseTest extends TestCase
{
    public function test_it_can_validate_at_least_one_lowercase_letter(): void
    {
        $this->expectException(InvalidPassword::class);

        $lowercase = new Lowercase();

        $lowercase('PASSWORD');
    }

    public function test_it_can_validate_at_least_two_lowercase_letters(): void
    {
        $this->expectException(InvalidPassword::class);

        $lowercase = new Lowercase(2);

        $lowercase('PASSWORd!');
    }
}
