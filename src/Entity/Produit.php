<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ficheDescriptive = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caracteristiques = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Utilisation $utilisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getVideo1(): ?string
    {
        return $this->video1;
    }

    public function setVideo1(?string $video1): self
    {
        $this->video1 = $video1;

        return $this;
    }

    public function getVideo2(): ?string
    {
        return $this->video2;
    }

    public function setVideo2(?string $video2): self
    {
        $this->video2 = $video2;

        return $this;
    }

    public function getFicheDescriptive(): ?string
    {
        return $this->ficheDescriptive;
    }

    public function setFicheDescriptive(?string $ficheDescriptive): self
    {
        $this->ficheDescriptive = $ficheDescriptive;

        return $this;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(string $caracteristiques): self
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    // fonction qui renvoie les caracteristiques du produit sous forme d'un tableau associatif
    // Exemple :
    // Array ( [Nombre de roues] => 4 [Freins] => électriques [Poids] => 5kg [Selle] => Extra confortable )
    public function getTableauCaracteristiques()
    {
        $res = array();
        $chaineCarac = $this->getCaracteristiques();

        $caracLine = explode(";", $chaineCarac);

        foreach ($caracLine as $elem) {
            $key = explode(":", $elem)[0];
            $value = explode(":", $elem)[1];
            $res += [$key => $value];
        }
        return $res;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getUtilisation(): ?Utilisation
    {
        return $this->utilisation;
    }

    public function setUtilisation(?Utilisation $utilisation): self
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
