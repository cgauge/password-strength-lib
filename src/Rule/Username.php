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

use CustomerGauge\Password\Exception\InvalidName;
use CustomerGauge\Password\Rule;

use function mb_strpos;
use function mb_strtolower;
use function mb_substr;

final class Username implements Rule
{
    public const INICIAL_SIZE = 4;

    /** @var string[] */
    private array $usernames;

    private string $encoding;

    /**
     * @param string[] $usernames
     */
    public function __construct(array $usernames, string $encoding = 'utf8')
    {
        $this->usernames = $usernames;
        $this->encoding  = $encoding;
    }

    public function __invoke(string $password): void
    {
        foreach ($this->usernames as $username) {
            $this->find($password, $username);

            $this->findNormalizedUsername($password, $username);

            $this->findInicialUsername($password, $username);
        }
    }

    private function find(string $password, string $username): void
    {
        if (mb_strpos($password, $username, 0, $this->encoding) !== false) {
            throw InvalidName::contains($username);
        }
    }

    private function findNormalizedUsername(string $password, string $username): void
    {
        $username = mb_strtolower($username, $this->encoding);
        $password = mb_strtolower($password, $this->encoding);

        $this->find($password, $username);
    }

    private function findInicialUsername(string $password, string $username): void
    {
        $username = mb_strtolower($username, $this->encoding);
        $password = mb_strtolower($password, $this->encoding);
        $inicials = mb_substr($username, 0, self::INICIAL_SIZE, $this->encoding);

        $this->find($password, $inicials);
    }
}
