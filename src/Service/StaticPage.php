<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\StaticPage as StaticPageEntity;
use App\Service\StaticPage\Repository;
use App\ValueObject\Identification;

class StaticPage
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $id): StaticPageEntity
    {
        return $this->repository->get(Identification::create($id));
    }
}
