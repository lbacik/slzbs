<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tournament
{
    private ?string $id = '';
    private string $name;
    private ?string $description = '';
    private bool $published;
    private DateTimeInterface $date;
    private DateTimeInterface $created;
    private DateTimeInterface $updated;
    private Collection $results;

    public function __construct()
    {
        $this->results = new ArrayCollection();

        $now = new DateTime();
        $this->date = $now;
        $this->created = $now;
        $this->updated = $now;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection|TournamentResult[]
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(TournamentResult $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setTournament($this);
        }

        return $this;
    }

    public function removeResult(TournamentResult $result): self
    {
        if ($this->results->contains($result)) {
            $this->results->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getTournament() === $this) {
                $result->setTournament(null);
            }
        }

        return $this;
    }
}
