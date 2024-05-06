<?php

namespace App\Entity;

use App\Repository\JeuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuxRepository::class)]
class Jeux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\ManyToOne(inversedBy: 'jeuxes')]
    private ?Developpeur $developpeur = null;

    #[ORM\ManyToOne(inversedBy: 'jeuxes')]
    private ?Editeur $editeur = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'jeux')]
    private Collection $commentaires;

    #[ORM\OneToMany(targetEntity: JeuPlatforme::class, mappedBy: 'jeux')]
    private Collection $jeuPlatformes;

    #[ORM\OneToMany(targetEntity: UserWishlist::class, mappedBy: 'jeux')]
    private Collection $userWishlists;

    #[ORM\OneToMany(targetEntity: Offre::class, mappedBy: 'jeux')]
    private Collection $offres;

    #[ORM\ManyToMany(targetEntity: JeuPlatforme::class)]
    #[ORM\JoinTable(name: 'jeux_plateformes')]
    private Collection $plateformes;


    public function __toString(): string
    {
        return $this->nom; // Return the name of the game or any appropriate string representation
    }
    public function __construct()
    {
        $this->plateformes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->jeuPlatformes = new ArrayCollection();
        $this->userWishlists = new ArrayCollection();
        $this->offres = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getDeveloppeur(): ?Developpeur
    {
        return $this->developpeur;
    }

    public function setDeveloppeur(?Developpeur $developpeur): static
    {
        $this->developpeur = $developpeur;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): static
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setJeux($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getJeux() === $this) {
                $commentaire->setJeux(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JeuPlatforme>
     */
    public function getJeuPlatformes(): Collection
    {
        return $this->jeuPlatformes;
    }

    public function addJeuPlatforme(JeuPlatforme $jeuPlatforme): static
    {
        if (!$this->jeuPlatformes->contains($jeuPlatforme)) {
            $this->jeuPlatformes->add($jeuPlatforme);
            $jeuPlatforme->setJeux($this);
        }

        return $this;
    }

    public function removeJeuPlatforme(JeuPlatforme $jeuPlatforme): static
    {
        if ($this->jeuPlatformes->removeElement($jeuPlatforme)) {
            // set the owning side to null (unless already changed)
            if ($jeuPlatforme->getJeux() === $this) {
                $jeuPlatforme->setJeux(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserWishlist>
     */
    public function getUserWishlists(): Collection
    {
        return $this->userWishlists;
    }

    public function addUserWishlist(UserWishlist $userWishlist): static
    {
        if (!$this->userWishlists->contains($userWishlist)) {
            $this->userWishlists->add($userWishlist);
            $userWishlist->setJeux($this);
        }

        return $this;
    }

    public function removeUserWishlist(UserWishlist $userWishlist): static
    {
        if ($this->userWishlists->removeElement($userWishlist)) {
            // set the owning side to null (unless already changed)
            if ($userWishlist->getJeux() === $this) {
                $userWishlist->setJeux(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): static
    {
        if (!$this->offres->contains($offre)) {
            $this->offres->add($offre);
            $offre->setJeux($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): static
    {
        if ($this->offres->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getJeux() === $this) {
                $offre->setJeux(null);
            }
        }

        return $this;
    }



}
