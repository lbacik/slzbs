<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class MenuItem
{
    /** @var string */
    private $name;

    /** @var string */
    private $uri;

    /** @var boolean */
    private $enabled;

    /** @var DateTime */
    private $created;

    /** @var DateTime */
    private $updated;

    private $id;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(?string $uri): self
    {
        $this->url = $uri;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
