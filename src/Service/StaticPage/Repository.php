<?php

declare(strict_types=1);

namespace App\Service\StaticPage;

use App\Entity\StaticPage as StaticPageEntity;
use App\ValueObject\Identification;

interface Repository
{
    public function get(Identification $id): StaticPageEntity;
}
