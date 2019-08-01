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

use CustomerGauge\Password\Exception\WeakTopology;
use CustomerGauge\Password\Rule;
use function in_array;
use function preg_replace;

final class Topology implements Rule
{
    /** @var string[] */
    private $topologies;

    public function __construct(string ...$topologies)
    {
        $this->topologies = $topologies;
    }

    public function __invoke(string $password) : void
    {
        $topology = $this->convertToTopology($password);

        if (in_array($topology, $this->topologies, true)) {
            throw WeakTopology::matches($topology);
        }
    }

    private function convertToTopology(string $password) : ?string
    {
        $patterns     = ['/[a-z]/', '/[A-Z]/', '/[0-9]/', '/[^lud]/'];
        $replacements = ['l', 'u', 'd', 's'];

        return preg_replace($patterns, $replacements, $password);
    }
}
