<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "Le nom doit faire au moins 4 caractères", maxMessage: "Le nom doit faire moins de 255 caractères")]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "Le titre doit faire au moins 4 caractères")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "La courte description est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "La description courte doit faire au moins 4 caractères")]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $video2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(min: 4, max: 255, minMessage: "La fiche descriptive doit faire au moins 4 caractères", maxMessage: "Lafiche descriptive doit faire moins de 255 caractères")]
    #[Assert\NotBlank(message: "La fiche descriptive est obligatoire")]
    private ?string $ficheDescriptive = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Les caractéristiques sont obligatoires")]
    #[Assert\Length(min: 4, minMessage: "Les caractéristiques doivent faire au moins 4 caractères")]
    private ?string $caracteristiques = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[Assert\NotBlank(message: "La catégorie est obligatoire")]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[Assert\NotBlank(message: "Le choix de type d'utilisation est obligatoire")]
    private ?Utilisation $utilisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Le slug est obligatoire")]
    #[Regex(
        pattern: "/\s/",
        match: false,
        message: "Le slug ne peut pas contenir d'espaces."
    )]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'image 1 est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image 1 doit faire entre 4 et 255 caractères", maxMessage: "L'image 1 doit faire entre 4 et 255 caractères")]
    private ?string $image1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'image 2 est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image 2 doit faire entre 4 et 255 caractères", maxMessage: "L'image 2 doit faire entre 4 et 255 caractères")]
    private ?string $image2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'image 3 est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image 3 doit faire entre 4 et 255 caractères", maxMessage: "L'image 3 doit faire entre 4 et 255 caractères")]
    private ?string $image3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "L'image 4 est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image 4 doit faire entre 4 et 255 caractères", maxMessage: "L'image 4 doit faire entre 4 et 255 caractères")]
    private ?string $image4 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "Les avantages sont obligatoires")]
    #[Assert\Length(min: 4, minMessage: "Les avantages doivent faire au moins 4 caractères")]
    private ?string $avantages = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[Assert\NotBlank(message: "La marque est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "La marque doit faire au moins 4 caractères")]
    private ?Marque $Marque = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "L'image 5 est obligatoire")]
    #[Assert\Length(min: 4, max: 255, minMessage: "L'image 5 doit faire entre 4 et 255 caractères", maxMessage: "L'image 5 doit faire entre 4 et 255 caractères")]
    private ?string $image5 = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    #[Assert\NotBlank(message: "Le prix est obligatoire")]
    #[Type(type: "float", message: "Le prix doit être un nombre décimal.")]
    private ?float $prix = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "La méta description est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "La méta description doit faire au moins 4 caractères")]
    private ?string $metaDesc = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "Les mots clés sont obligatoires")]
    #[Assert\Length(min: 4, minMessage: "Les mots clés doivent faire au moins 4 caractères")]
    private ?string $motsCles = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'produitsSimilaires')]
    private Collection $produitsSimilaires;

    public function __construct()
    {
        $this->produitsSimilaires = new ArrayCollection();
    }

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

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }

    public function getAvantages(): ?string
    {
        return $this->avantages;
    }

    public function setAvantages(?string $avantages): self
    {
        $this->avantages = $avantages;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getImage5(): ?string
    {
        return $this->image5;
    }

    public function setImage5(?string $image5): self
    {
        $this->image5 = $image5;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMetaDesc(): ?string
    {
        return $this->metaDesc;
    }

    public function setMetaDesc(?string $metaDesc): self
    {
        $this->metaDesc = $metaDesc;

        return $this;
    }

    public function getMotsCles(): ?string
    {
        return $this->motsCles;
    }

    public function setMotsCles(?string $motsCles): self
    {
        $this->motsCles = $motsCles;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProduitsSimilaires(): Collection
    {
        return $this->produitsSimilaires;
    }

    public function addProduitsSimilaire(self $produitsSimilaire): self
    {
        if (!$this->produitsSimilaires->contains($produitsSimilaire)) {
            $this->produitsSimilaires->add($produitsSimilaire);
        }

        return $this;
    }

    public function removeProduitsSimilaire(self $produitsSimilaire): self
    {
        $this->produitsSimilaires->removeElement($produitsSimilaire);

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
