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

use CustomerGauge\Password\Exception\SequencialNumber as SequencialNumberException;
use CustomerGauge\Password\Rule;
use function mb_strlen;

final class SequencialNumber implements Rule
{
    public const ASCENDING  = 'ASC';
    public const DESCENDING = 'DESC';

    /** @var int */
    private $count;

    /** @var string */
    private $encoding;

    public function __construct(int $count = 3, string $encoding = 'utf8')
    {
        $this->count    = $count;
        $this->encoding = $encoding;
    }

    public function __invoke(string $password) : void
    {
        $length = (int) mb_strlen($password, $this->encoding);

        $this->find($password, $length, self::ASCENDING);
        $this->find($password, $length, self::DESCENDING);
    }

    private function find(string $password, int $length, string $direction) : void
    {
        $chained = 1;

        for ($i = 1; $i < $length; $i++) {
            $current  = (int) $password[$i];
            $previous = (int) $password[$i-1];

            $direction === self::ASCENDING ? $previous++ : $previous--;

            $current === $previous ? $chained++ : $chained = 1;

            if ($chained === $this->count) {
                throw SequencialNumberException::notAllowed();
            }
        }
    }
}
