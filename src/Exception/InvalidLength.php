<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

use function sprintf;

class InvalidLength extends InvalidPassword
{
    public static function requires(string $type, int $required, int $provided) : self
    {
        $message = sprintf(
            'The %s length should be %d character(s) and %d was provided.',
            $type,
            $required,
            $provided
        );

        return new static($message);
    }
}
