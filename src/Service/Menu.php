<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Menu\MenuItemCollection;

class Menu
{
    /** @var MenuItemRepository */
    private $itemRepository;

    public function __construct(MenuItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function items(): MenuItemCollection
    {
        return $this->itemRepository->items();
    }
}
