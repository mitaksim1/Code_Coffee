<?php

namespace App\Entity;

use App\Repository\TechnologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
class Technology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\Column(type: 'boolean')]
    private $isActive;

    #[ORM\OneToMany(mappedBy: 'technology', targetEntity: UserTechnology::class, orphanRemoval: true)]
    private $userTechnologies;

    public function __construct()
    {
        $this->userTechnologies = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, UserTechnology>
     */
    public function getUserTechnologies(): Collection
    {
        return $this->userTechnologies;
    }

    public function addUserTechnology(UserTechnology $userTechnology): self
    {
        if (!$this->userTechnologies->contains($userTechnology)) {
            $this->userTechnologies[] = $userTechnology;
            $userTechnology->setTechnology($this);
        }

        return $this;
    }

    public function removeUserTechnology(UserTechnology $userTechnology): self
    {
        if ($this->userTechnologies->removeElement($userTechnology)) {
            // set the owning side to null (unless already changed)
            if ($userTechnology->getTechnology() === $this) {
                $userTechnology->setTechnology(null);
            }
        }

        return $this;
    }
}
