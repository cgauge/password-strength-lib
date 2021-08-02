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

namespace CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\InvalidLength;
use CustomerGauge\Password\Rule;

use function mb_strlen;

final class Length implements Rule
{
    private int $min;

    private ?int $max = null;

    private string $encoding;

    public function __construct(int $min, ?int $max = null, string $encoding = 'utf8')
    {
        $this->min      = $min;
        $this->max      = $max;
        $this->encoding = $encoding;
    }

    public function __invoke(string $password): void
    {
        $length = (int) mb_strlen($password, $this->encoding);

        if ($length < $this->min) {
            throw InvalidLength::requires('min', $this->min, $length);
        }

        if ($this->max && $length > $this->max) {
            throw InvalidLength::requires('max', $this->max, $length);
        }
    }
}
