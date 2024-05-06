<?php

namespace App\Entity;

use App\Repository\UserWishlistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserWishlistRepository::class)]
class UserWishlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userWishlists')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userWishlists')]
    private ?Jeux $jeux = null;

    #[ORM\Column]
    private ?bool $estPublique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getJeux(): ?Jeux
    {
        return $this->jeux;
    }

    public function setJeux(?Jeux $jeux): static
    {
        $this->jeux = $jeux;

        return $this;
    }

    public function isEstPublique(): ?bool
    {
        return $this->estPublique;
    }

    public function setEstPublique(bool $estPublique): static
    {
        $this->estPublique = $estPublique;

        return $this;
    }
}
