<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Exception;

class SequencialNumber extends InvalidPassword
{
    public static function notAllowed() : self
    {
        return new static('Sequencial number are not allowed.');
    }
}
