<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\InvalidCharacterType;
use CustomerGauge\Password\Rule;
use function count;
use function preg_match;

final class Digit implements Rule
{
    /** @var int */
    private $count;

    public function __construct(int $count = 1)
    {
        $this->count = $count;
    }

    public function __invoke(string $password) : void
    {
        preg_match('/[0-9]/', $password, $matches);

        if (count($matches) < $this->count) {
            throw InvalidCharacterType::requires('digit', $this->count, count($matches));
        }
    }
}
