<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\StaticPage as StaticPageEntity;
use App\Service\StaticPage\Exception\StaticPageException;

class StaticPage
{
    /** @var StaticPageRepository */
    private $repository;

    public function __construct(StaticPageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws StaticPageException
     */
    public function get(int $id): StaticPageEntity
    {
        $page = $this->repository->get($id);

        if ($page === null || $page->getEnabled() === false) {
            throw StaticPageException::pageNotFound($id);
        }

        return $page;
    }
}
