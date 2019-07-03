[![Build Status](https://travis-ci.org/cgauge/password-strength-lib.svg?branch=master)](https://travis-ci.org/cgauge/password-strength-lib)
[![Code Coverage](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cgauge/password-strength-lib/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/customergauge/password.svg)](https://packagist.org/packages/customergauge/password)
[![License](https://img.shields.io/packagist/l/customergauge/password.svg?color=%234c1)](https://packagist.org/packages/customergauge/password)
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
## Persist Rule Chain

Use PersistRuleChain class when you want to continue the execution even if a rule throws an InvalidPassword exception.

```php
use Customergauge\Password\Rule\Lowercase;
use Customergauge\Password\Rule\Uppercase;
use Customergauge\Password\Rule\Length;
use Customergauge\Password\RuleChain;
use Customergauge\Password\Exception\InvalidPassword;

$validate = new PersistRuleChain(
  new Lowercase(2),
  new Uppercase(2),
  new Length(10),
  new Digit(3)
);

$password = "ABcd00efgh";

if ($validate($password)) {
    echo "valid";
} else {
    echo "invalid";
    // It is possible to get all exceptions using $validate->exceptions();
}

// output: invalid
```

# Contributing

Contributions are always welcome, please have a look at our issues to see if there's something you could help with.

# License

Password Strength is licensed under MIT license.
