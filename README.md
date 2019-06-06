[![Build Status](https://travis-ci.org/cgauge/password-strength-lib.svg?branch=master)](https://travis-ci.org/cgauge/password-strength-lib)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/?branch=master)

# Password Strength Library 🔒

This library is used to validade the strength of a password. It's composed by a set of Rules that can be used individualy or aggregated by a rule chain.

# Installation

```bash
composer require customergauge/password
```
# Usage

## Single Rule

```php
use Customergauge\Password\Rule\Lowercase;
use Customergauge\Password\Exception\InvalidPassword;

$validate = new Lowercase;
$password = "UPPERCASE";

try {
    $validate($password);
} catch (InvalidPassword $e) {
    echo $e->getMessage();
}

// output: Password should have at least 1 lowercase character(s) but 0 found.
```

## Rule Chain

```php
use Customergauge\Password\Rule\Lowercase;
use Customergauge\Password\Rule\Uppercase;
use Customergauge\Password\Rule\Length;
use Customergauge\Password\RuleChain;
use Customergauge\Password\Exception\InvalidPassword;

$validate = new RuleChain(
  new Lowercase(2),
  new Uppercase(2),
  new Length(10),
  new Digit(3)
);

$password = "ABcd00efgh";

try {
    $validate($password);
} catch (InvalidPassword $e) {
    echo $e->getMessage();
}

// output: Password should have at least 3 digit character(s) but 2 found.
```

# LICENSE

MIT
