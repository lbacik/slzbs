<?php

declare(strict_types=1);

namespace App\ValueObject;

use Sushi\Validator\IlluminateValidationValidator;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;

class BaseEmptyValueObject extends ValueObject
{
    protected $validators = [
        KeysValidator::class,
        IlluminateValidationValidator::class,
    ];
}
