<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\StaticPage as StaticPageEntity;
use App\Service\StaticPageRepository as StaticPageRepositoryInterface;

class StaticPageRepository extends GenericRepository implements StaticPageRepositoryInterface
{
    public function get(int $id): ?StaticPageEntity
    {
        $page = $this->getEntityManager()
            ->find(
                StaticPageEntity::class,
                $id
            );

        return $page;
    }
}
