<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Sushi\Validator\IlluminateValidationValidator;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;

abstract class ObjectCollection extends ValueObject
{
    protected const ITEMS = 'items';

    protected $validators = [
        KeysValidator::class,
        IlluminateValidationValidator::class,
    ];

    public function item(): iterable
    {
        foreach ($this->getValues()[self::ITEMS] as $item) {
            yield $item;
        }
    }
}
