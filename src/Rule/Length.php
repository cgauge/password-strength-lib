<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\InvalidLength;
use CustomerGauge\Password\Rule;
use function mb_strlen;

final class Length implements Rule
{
    /** @var int */
    private $min;

    /** @var int|null */
    private $max;

    /** @var string */
    private $encoding;

    public function __construct(int $min, ?int $max = null, string $encoding = 'utf8')
    {
        $this->min      = $min;
        $this->max      = $max;
        $this->encoding = $encoding;
    }

    public function __invoke(string $password) : void
    {
        $length = (int) mb_strlen($password, $this->encoding);

        if ($length < $this->min) {
            throw InvalidLength::requires('min', $this->min, $length);
        }

        if ($this->max && $length > $this->max) {
            throw InvalidLength::requires('max', $this->max, $length);
        }
    }
}
