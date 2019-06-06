<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

use function sprintf;

class InvalidCharacterType extends InvalidPassword
{
    public static function requires(string $type, int $required, int $provided) : self
    {
        $message = sprintf(
            'Password should have at least %d %s character(s) but %d found.',
            $required,
            $type,
            $provided
        );

        return new static($message);
    }
}
