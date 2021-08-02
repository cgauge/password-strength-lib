<?php
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

declare(strict_types=1);

namespace CustomerGauge\Password;

use CustomerGauge\Password\Exception\InvalidPassword;

use function random_int;
use function strlen;

final class Generator
{
    private Rule $rule;

    private int $length;

    public function __construct(Rule $rule, int $length = 12)
    {
        $this->rule   = $rule;
        $this->length = $length;
    }

    public function __invoke(): string
    {
        try {
            $password = $this->generate();

            $this->rule->__invoke($password);

            return $password;
        } catch (InvalidPassword $e) {
            return $this->__invoke();
        }
    }

    public function generate(): string
    {
        $chars    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
        $password = '';

        $max = strlen($chars) - 1;

        for ($i = 0; $i < $this->length; $i++) {
            $password .= $chars[random_int(0, $max)];
        }

        return $password;
    }
}
