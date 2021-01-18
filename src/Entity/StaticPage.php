<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class StaticPage
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $body;

    /** @var boolean */
    private $enabled;

    /** @var DateTime */
    private $created;

    /** @var DateTime */
    private $updated;

    public function __construct()
    {
        $this->id = -1;
        $this->title = '';
        $this->body = '';
        $this->enabled = true;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(?string $body): void
    {
        $this->body = $body ?? '';
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}
