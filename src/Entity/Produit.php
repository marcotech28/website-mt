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

    #[ORM\Column(length: 255)]
    private ?string $descriptioCourte = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionCourte = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ficheDescriptive = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $caracteristiques = null;

    #[ORM\Column]
    private ?float $prixHT = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ficheTarifProd = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image3 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptioCourte(): ?string
    {
        return $this->descriptioCourte;
    }

    public function setDescriptioCourte(string $descriptioCourte): self
    {
        $this->descriptioCourte = $descriptioCourte;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->descriptionCourte;
    }

    public function setDescriptionCourte(string $descriptionCourte): self
    {
        $this->descriptionCourte = $descriptionCourte;

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

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getFicheTarifProd(): ?string
    {
        return $this->ficheTarifProd;
    }

    public function setFicheTarifProd(?string $ficheTarifProd): self
    {
        $this->ficheTarifProd = $ficheTarifProd;

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
}
