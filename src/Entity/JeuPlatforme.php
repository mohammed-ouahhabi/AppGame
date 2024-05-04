<?php

namespace App\Entity;

use App\Repository\JeuPlatformeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuPlatformeRepository::class)]
class JeuPlatforme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'jeuPlatformes')]
    private ?jeux $jeux = null;

    #[ORM\Column(length: 255)]
    private ?string $plateforme = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlateforme(): ?string
    {
        return $this->plateforme;
    }

    public function setPlateforme(string $plateforme): static
    {
        $this->plateforme = $plateforme;

        return $this;
    }
}
