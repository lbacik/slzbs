<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Menu\MenuItemCollection;

interface MenuItemRepository
{
    public function items(): MenuItemCollection;
}
