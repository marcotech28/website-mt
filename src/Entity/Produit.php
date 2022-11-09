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
    private ?string $description_courte = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fiche_descriptive = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $caracteristiques = null;

    #[ORM\Column]
    private ?float $prix_ht = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fiche_tarif_prod = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;



    public function getDescriptionCourte(): ?string
    {
        return $this->descriptionCourte;
    }

    public function setDescriptionCourte(string $descriptionCourte): self
    {
        $this->descriptionCourte = $descriptionCourte;

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
        return $this->fiche_descriptive;
    }

    public function setFicheDescriptive(?string $fiche_descriptive): self
    {
        $this->fiche_descriptive = $fiche_descriptive;

        return $this;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(?string $caracteristiques): self
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    public function getPrixHt(): ?float
    {
        return $this->prix_ht;
    }

    public function setPrixHt(float $prix_ht): self
    {
        $this->prix_ht = $prix_ht;

        return $this;
    }

    public function getFicheTarifProd(): ?string
    {
        return $this->fiche_tarif_prod;
    }

    public function setFicheTarifProd(?string $fiche_tarif_prod): self
    {
        $this->fiche_tarif_prod = $fiche_tarif_prod;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(?string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

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
