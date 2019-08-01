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
use function count;

final class PersistRuleChain
{
    /** @var callable[] */
    private $rules;

    /** @var InvalidPassword[] */
    private $exceptions = [];

    public function __construct(callable ...$rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return InvalidPassword[]
     */
    public function exceptions() : array
    {
        return $this->exceptions;
    }

    public function __invoke(string $password) : bool
    {
        $this->exceptions = [];
        
        foreach ($this->rules as $validate) {
            try {
                $validate($password);
            } catch (InvalidPassword $e) {
                $this->exceptions[] = $e;
            }
        }

        if (count($this->exceptions)) {
            return false;
        }

        return true;
    }
}
