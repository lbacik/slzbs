<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

class MenuItem
{
    /** @var integer */
    private $id;

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

    public function __construct(?string $name = '', ?string $uri = '', ?bool $enable = false)
    {
        $this->name = $name;
        $this->uri = $uri;
        $this->enabled = $enable;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
        $this->uri = $uri;

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
}
