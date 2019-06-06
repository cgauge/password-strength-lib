<?php

declare(strict_types=1);

namespace CustomerGauge\Password\Rule;

use CustomerGauge\Password\Exception\InBlacklist;
use CustomerGauge\Password\Rule;
use function mb_strpos;

final class Blacklist implements Rule
{
    /** @var string[] */
    private $words;

    /** @var string */
    private $encoding;

    /**
     * @param string[] $words
     */
    public function __construct(array $words, string $encoding = 'utf8')
    {
        $this->words    = $words;
        $this->encoding = $encoding;
    }

    public function __invoke(string $password) : void
    {
        foreach ($this->words as $word) {
            if (mb_strpos($password, $word, 0, $this->encoding) !== false) {
                throw InBlacklist::contains($word);
            }
        }
    }
}
