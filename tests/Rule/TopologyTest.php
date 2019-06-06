<?php

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
