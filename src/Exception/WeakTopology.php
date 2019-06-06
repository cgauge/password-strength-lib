<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

use function sprintf;

class WeakTopology extends InvalidPassword
{
    public static function matches(string $topology) : self
    {
        return new static(sprintf('Common topology [%s] is not allowed.', $topology));
    }
}
