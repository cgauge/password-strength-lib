<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

use function sprintf;

class InBlacklist extends InvalidPassword
{
    public static function contains(string $word) : self
    {
        return new static(sprintf('Word [%s] is not valid.', $word));
    }
}
