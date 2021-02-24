<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private ?string $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $content;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": false})
     */
    private bool $published;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $updated;

    public function __construct(?string $content = '', ?bool $published = false)
    {
        $this->id = '';
        $this->content = $content ?? '';
        $this->published = $published ?? 0;

        $now = new DateTime();
        $this->date = $now;
        $this->created = $now;
        $this->updated = $now;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    public function getUpdated(): DateTimeInterface
    {
        return $this->updated;
    }
}
