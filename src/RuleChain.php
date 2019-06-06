<?php

declare(strict_types=1);

namespace CustomerGauge\Password;

final class RuleChain implements Rule
{
    /** @var callable[] */
    private $rules;

    public function __construct(callable ...$rules)
    {
        $this->rules = $rules;
    }

    public function __invoke(string $password) : void
    {
        foreach ($this->rules as $validate) {
            $validate($password);
        }
    }
}
