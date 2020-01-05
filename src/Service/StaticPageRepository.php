<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\StaticPage as StaticPageEntity;

interface StaticPageRepository
{
    public function get(int $id): ?StaticPageEntity;
}
