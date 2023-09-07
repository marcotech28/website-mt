<?php

namespace App\Entity;

use App\Repository\UtilisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisationRepository::class)]
class Utilisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le libelle est obligatoire")]
    #[Assert\Length(min: 4, max: 40, minMessage: "Le libelle doit faire au minimum 4 caractères", maxMessage: "Le libelle doit faire au maximum 40 caractères")]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'image est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "Le lien de l'image doit faire au minimum 4 caractères")]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Le slug est obligatoire")]
    #[Assert\Length(min: 4, max: 40, minMessage: "Le slug doit faire au minimum 4 caractères", maxMessage: "Le slug doit faire au maximum 40 caractères")]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'utilisation', targetEntity: Produit::class)]
    private Collection $produits;

    #[ORM\ManyToOne(inversedBy: 'utilisations')]
    #[Assert\NotBlank(message: "La catégorie est obligatoire")]
    private ?Categorie $categorie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "La description doit faire au minimum 4 caractères")]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleDetail = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La méta description est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "La méta description doit faire au minimum 4 caractères")]
    private ?string $metaDesc = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\NotBlank(message: "texte de fin est obligatoire")]
    #[Assert\Length(min: 4, minMessage: "Le texte de fin doit faire au minimum 4 caractères")]
    private ?string $texteDeFin = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setUtilisation($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getUtilisation() === $this) {
                $produit->setUtilisation(null);
            }
        }

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLibelleDetail(): ?string
    {
        return $this->libelleDetail;
    }

    public function setLibelleDetail(?string $libelleDetail): self
    {
        $this->libelleDetail = $libelleDetail;

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

    public function getTexteDeFin(): ?string
    {
        return $this->texteDeFin;
    }

    public function setTexteDeFin(?string $texteDeFin): self
    {
        $this->texteDeFin = $texteDeFin;

        return $this;
    }
}
