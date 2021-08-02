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

namespace Tests\CustomerGauge\Password;

use CustomerGauge\Password\Rule;
use CustomerGauge\Password\RuleChain;
use PHPUnit\Framework\TestCase;

class RuleChainTest extends TestCase
{
    public function test_it_can_validate_rules(): void
    {
        $rule = $this->createMock(Rule::class);

        $rule->expects($this->once())
            ->method('__invoke');

        $validate = new RuleChain($rule);

        $validate('password');
    }

    public function test_it_can_validate_callables(): void
    {
        $function = static function (): void {
        };

        $customMethod = new FixtureCustomMethod();

        $rule = $this->createMock(Rule::class);

        $rule->expects($this->once())
            ->method('__invoke');

        $validate = new RuleChain(
            'is_string',
            $function,
            [$customMethod, 'customMethod'],
            $rule
        );

        $validate('password');
    }
}

class FixtureCustomMethod
{
    public function customMethod(string $value): void
    {
    }
}
