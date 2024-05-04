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
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'userWishlists')]
    private ?jeux $jeux = null;

    #[ORM\Column]
    private ?bool $estPublique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getJeux(): ?jeux
    {
        return $this->jeux;
    }

    public function setJeux(?jeux $jeux): static
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
