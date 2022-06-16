<?php

namespace App\Entity;

use App\Repository\UserTechnologyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTechnologyRepository::class)]
class UserTechnology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Technology::class, inversedBy: 'userTechnologies')]
    #[ORM\JoinColumn(nullable: false)]
    private $technology;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userTechnologies')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $experience;

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnology(): ?Technology
    {
        return $this->technology;
    }

    public function setTechnology(?Technology $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }
}
