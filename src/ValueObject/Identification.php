<?php

declare(strict_types=1);

namespace App\ValueObject;

use Sushi\ValueObject;

class Identification extends BaseEmptyValueObject
{
    const KEY_ID = 'id';

    protected $keys = [
        self::KEY_ID => 'required',
    ];

    public function value(): string
    {
        return $this->offsetGet(self::KEY_ID);
    }

    public static function create(string $uuid): self
    {
        return new static ([
            self::KEY_ID => $uuid,
        ]);
    }
}
