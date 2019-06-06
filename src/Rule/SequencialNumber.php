<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\SequencialNumber as SequencialNumberException;
use CustomerGauge\Password\Rule;
use function mb_strlen;

final class SequencialNumber implements Rule
{
    public const ASCENDING  = 'ASC';
    public const DESCENDING = 'DESC';

    /** @var int */
    private $count;

    /** @var string */
    private $encoding;

    public function __construct(int $count = 3, string $encoding = 'utf8')
    {
        $this->count    = $count;
        $this->encoding = $encoding;
    }

    public function __invoke(string $password) : void
    {
        $length = (int) mb_strlen($password, $this->encoding);

        $this->find($password, $length, self::ASCENDING);
        $this->find($password, $length, self::DESCENDING);
    }

    private function find(string $password, int $length, string $direction) : void
    {
        $chained = 1;

        for ($i = 1; $i < $length; $i++) {
            $current  = (int) $password[$i];
            $previous = (int) $password[$i-1];

            $direction === self::ASCENDING ? $previous++ : $previous--;

            $current === $previous ? $chained++ : $chained = 1;

            if ($chained === $this->count) {
                throw SequencialNumberException::notAllowed();
            }
        }
    }
}
