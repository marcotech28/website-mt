<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsRepository;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "Le titre doit faire au moins 4 caractères", maxMessage: "Le titre doit faire moins de 255 caractères")]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'auteur est obligatoire")]
    #[Assert\Length(min: 4, max: 30, minMessage: "L'auteur doit faire entre 4 et 30 caractères", maxMessage: "L'auteur doit faire entre 4 et 30 caractères")]
    private ?string $auteur = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 4, max: 255, minMessage: "Le sous titre doit faire au minimum 4 caractères", maxMessage: "Le sous titre doit faire au maximum 255 caractères")]
    #[Assert\NotBlank(message: "Le sous titre est obligatoire")]
    private ?string $sousTitre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le slug est obligatoire")]
    #[Regex(
        pattern: "/\s/",
        match: false,
        message: "Le slug du titre ne peut pas contenir d'espaces."
    )]
    private ?string $titreSlug = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 4, max: 255, minMessage: "La méta description doit faire entre 4 et 255 caractères", maxMessage: "La méta description doit faire entre 4 et 255 caractères")]
    #[Assert\NotBlank(message: "La méta description est obligatoire")]
    private ?string $metaDesc = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 5, minMessage: "Contenu invalide", maxMessage: "Contenu invalide")]
    #[Assert\NotBlank(message: "Le contenu est obligatoire")]
    private ?string $contenu = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'image est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image doit faire entre 4 et 255 caractères", maxMessage: "L'image doit faire entre 4 et 255 caractères")]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDraft = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(string $sousTitre): self
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    public function getTitreSlug(): ?string
    {
        return $this->titreSlug;
    }

    public function setTitreSlug(string $titreSlug): self
    {
        $this->titreSlug = $titreSlug;

        return $this;
    }

    public function getMetaDesc(): ?string
    {
        return $this->metaDesc;
    }

    public function setMetaDesc(string $metaDesc): self
    {
        $this->metaDesc = $metaDesc;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isIsDraft(): ?bool
    {
        return $this->isDraft;
    }

    public function setIsDraft(?bool $isDraft): static
    {
        $this->isDraft = $isDraft;

        return $this;
    }
}
