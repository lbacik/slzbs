<?php

declare(strict_types=1);

namespace App\Service\StaticPage\Exception;

use RuntimeException;

class StaticPageException extends RuntimeException
{
    public static function pageNotFound(int $id): self
    {
        return new static("Page not found! Page id: {$id}");
    }
}
