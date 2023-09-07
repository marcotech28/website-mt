<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un utilisateur possède déjà cet email.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(message: "Email non valide")]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(min: 6, max: 255, minMessage: "Le mot de passe doit faire au minimum 6 caractères", maxMessage: "Le mot de passe doit faire au maximum 255 caractères")]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 4, max: 255, minMessage: "Le prénom doit faire au moins 4 caractères", maxMessage: "Le prénom doit faire moins de 255 caractères")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 4, max: 255, minMessage: "Le nom doit faire au moins 4 caractères", maxMessage: "Le nom doit faire moins de 255 caractères")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 4, max: 30, minMessage: "Le téléphone doit faire au moins 4 caractères", maxMessage: "Le téléphone doit faire moins de 30 caractères")]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 30, minMessage: "Le pays doit faire au moins 3 caractères", maxMessage: "Le pays doit faire moins de 30 caractères")]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 50, minMessage: "L'adresse doit faire au moins 3 caractères", maxMessage: "L\'adresse doit faire moins de 50 caractères")]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 3, max: 50, minMessage: "Le complément d'adresse doit faire au moins 3 caractères", maxMessage: "Le complément d'adresse doit faire moins de 50 caractères")]
    private ?string $complementAdresse = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 30, minMessage: "La ville doit faire au moins 3 caractères", maxMessage: "La ville doit faire moins de 30 caractères")]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 30, minMessage: "Le code postal doit faire au moins 3 caractères", maxMessage: "Le code postal doit faire moins de 30 caractères")]
    private ?string $codePostal = null;

    #[ORM\Column]
    private ?bool $newsletter = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 2, max: 30, minMessage: "Le nom de société doit faire au moins 2 caractères", maxMessage: "Le nom de société est trop grand")]
    private ?string $nomSociete = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 30, minMessage: "Votre fonction doit faire au moins 3 caractères", maxMessage: "Votre fonction est trop longue")]
    private ?string $fonction = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isConfirmed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getComplementAdresse(): ?string
    {
        return $this->complementAdresse;
    }

    public function setComplementAdresse(?string $complementAdresse): self
    {
        $this->complementAdresse = $complementAdresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    public function setNomSociete(string $nomSociete): self
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function isIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(?bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }
}
