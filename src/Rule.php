<?php

declare(strict_types=1);

namespace CustomerGauge\Password;

interface Rule
{
    public function __invoke(string $password) : void;
}
