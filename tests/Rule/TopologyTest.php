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

namespace Tests\CustomerGauge\Password\Rule;

use PHPUnit\Framework\TestCase;
use CustomerGauge\Password\Rule\Topology;
use CustomerGauge\Password\Exception\InvalidPassword;

class TopologyTest extends TestCase
{
    /**
     * @dataProvider topologies
     */
    public function test_it_can_validate_a_topology($format, $password)
    {
        self::expectException(InvalidPassword::class);

        $topology = new Topology($format); 

        $topology($password);
    }

    public function topologies()
    {
        return [
            'using lowercase' => ['lll', 'abc'],
            'using uppercase' => ['uuu', 'ABC'],
            'using digits'    => ['ddd', '123'],
            'using symbols'   => ['sss', '!@#'],
            'using mixed'     => ['ulds', 'Ab1!'],
        ];
    } 
}
