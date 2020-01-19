<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\MenuItem;
use App\Entity\StaticPage as StaticPageEntity;
use App\Service\Menu\MenuItemCollection;
use App\Service\MenuItemRepository as MenuItemRepositoryInterface;
use Illuminate\Validation\ValidationException;

class MenuItemRepository extends GenericRepository implements MenuItemRepositoryInterface
{
    public function items(): MenuItemCollection
    {
        $result = $this->getEntityManager()
            ->getRepository(
                MenuItem::class
            )
            ->findBy(['enabled' => true]);

        return MenuItemCollection::create($result);
    }
}
