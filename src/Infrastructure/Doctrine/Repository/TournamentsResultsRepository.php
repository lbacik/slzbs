<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\Tournament;

class TournamentsResultsRepository extends GenericRepository
{
    public function items(): array
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('t, r')
            ->from(Tournament::class, 't')
            ->innerJoin('t.results', 'r')
            ->where('t.published = 1')
            ->andWhere('r.published = 1')
            ->orderBy('t.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
