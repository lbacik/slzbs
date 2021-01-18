<?php

declare(strict_types=1);

namespace App\Service\Menu;

use App\Entity\MenuItem;
use App\Infrastructure\ObjectCollection;

class MenuItemCollection extends ObjectCollection
{
    protected $keys = [
        self::ITEMS => 'array',
        self::ITEMS . '.*' => 'instance_of:' . MenuItem::class,
    ];

    public static function create(array $items): self
    {
        return new static([
            self::ITEMS => $items,
        ]);
    }
}
