<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?jeux $jeux = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $lien = null;

    #[ORM\Column(length: 255)]
    private ?string $edition = null;

    #[ORM\Column(length: 255)]
    private ?string $plateformeJeu = null;

    #[ORM\Column(length: 255)]
    private ?string $plateformeActivation = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    private ?coupon $coupon = null;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): static
    {
        $this->edition = $edition;

        return $this;
    }

    public function getPlateformeJeu(): ?string
    {
        return $this->plateformeJeu;
    }

    public function setPlateformeJeu(string $plateformeJeu): static
    {
        $this->plateformeJeu = $plateformeJeu;

        return $this;
    }

    public function getPlateformeActivation(): ?string
    {
        return $this->plateformeActivation;
    }

    public function setPlateformeActivation(string $plateformeActivation): static
    {
        $this->plateformeActivation = $plateformeActivation;

        return $this;
    }

    public function getCoupon(): ?coupon
    {
        return $this->coupon;
    }

    public function setCoupon(?coupon $coupon): static
    {
        $this->coupon = $coupon;

        return $this;
    }
}
