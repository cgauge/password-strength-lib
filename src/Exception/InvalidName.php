<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

use function sprintf;

class InvalidName extends InvalidPassword
{
    public static function contains(string $name) : self
    {
        return new static(sprintf('The [%s] should not be used.', $name));
    }
}
