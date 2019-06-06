<?php

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
