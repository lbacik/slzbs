<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Entity\Tournament;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TournamentsResultsRepository extends GenericRepository
{
    public function items(int $perPage = 10, int $offset = 0): Paginator
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('t, r')
            ->from(Tournament::class, 't')
            ->innerJoin('t.results', 'r')
            ->where('t.published = 1')
            ->andWhere('r.published = 1')
            ->orderBy('t.date', 'DESC')
            ->setMaxResults($perPage)
            ->setFirstResult($offset)
            ->getQuery();

            return new Paginator($query);
    }
}
