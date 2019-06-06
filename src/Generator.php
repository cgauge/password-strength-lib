<?php

declare(strict_types=1);

namespace CustomerGauge\Password;

use CustomerGauge\Password\Exception\InvalidPassword;
use function random_int;
use function strlen;

final class Generator
{
    /** @var Rule */
    private $rule;

    /** @var int */
    private $length;

    public function __construct(Rule $rule, int $length = 12)
    {
        $this->rule   = $rule;
        $this->length = $length;
    }

    public function __invoke() : string
    {
        try {
            $password = $this->generate();

            $this->rule->__invoke($password);

            return $password;
        } catch (InvalidPassword $e) {
            return $this->__invoke();
        }
    }

    public function generate() : string
    {
        $chars    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
        $password = '';

        $max = strlen($chars) - 1;

        for ($i = 0; $i < $this->length; $i++) {
            $password .= $chars[random_int(0, $max)];
        }

        return $password;
    }
}
