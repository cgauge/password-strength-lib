<?php

declare(strict_types=1);

namespace CustomerGauge\Password;

use CustomerGauge\Password\Exception\InvalidPassword;
use function count;

final class PersistRuleChain
{
    /** @var callable[] */
    private $rules;

    /** @var InvalidPassword[] */
    private $exceptions = [];

    public function __construct(callable ...$rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return InvalidPassword[]
     */
    public function exceptions() : array
    {
        return $this->exceptions;
    }

    public function __invoke(string $password) : bool
    {
        $this->exceptions = [];
        
        foreach ($this->rules as $validate) {
            try {
                $validate($password);
            } catch (InvalidPassword $e) {
                $this->exceptions[] = $e;
            }
        }

        if (count($this->exceptions)) {
            return false;
        }

        return true;
    }
}
