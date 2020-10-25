<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\News;

class NewsRepository extends GenericRepository
{
    public function items(): array
    {
        return $this->getEntityManager()
            ->getRepository(News::class)
            ->findBy(
                [
                    'published' => 1,
                ],
                [
                    'date' => 'DESC',
                ]
            );
    }
}
