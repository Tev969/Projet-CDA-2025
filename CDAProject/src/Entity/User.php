<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(nullable:true)]
    private ?float $size = null;

    #[ORM\Column(nullable:true)]
    private ?float $age = null;

    #[ORM\Column(length: 255, nullable:true)]
    private ?string $sexe = null;

    #[ORM\Column(nullable:true)]
    private ?float $weight = null;

    #[ORM\Column(length: 20 , nullable:true)]
    private ?string $level = null;

    #[ORM\Column(nullable:true)]
    private ?float $week_activity = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: '_user')]
    private Collection $articles;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\ManyToMany(targetEntity: Exercice::class, inversedBy: 'users')]
    private Collection $exercices;

    /**
     * @var Collection<int, Program>
     */
    #[ORM\ManyToMany(targetEntity: Program::class, inversedBy: 'users')]
    private Collection $registers;

    /**
     * @var Collection<int, Program>
     */
    #[ORM\OneToMany(targetEntity: Program::class, mappedBy: '_user')]
    private Collection $createPrograms;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->exercices = new ArrayCollection();
        $this->registers = new ArrayCollection();
        $this->createPrograms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getAge(): ?float
    {
        return $this->age;
    }

    public function setAge(float $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getWeekActivity(): ?float
    {
        return $this->week_activity;
    }

    public function setWeekActivity(float $week_activity): static
    {
        $this->week_activity = $week_activity;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        $this->exercices->removeElement($exercice);

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getRegisters(): Collection
    {
        return $this->registers;
    }

    public function addRegister(Program $register): static
    {
        if (!$this->registers->contains($register)) {
            $this->registers->add($register);
        }

        return $this;
    }

    public function removeRegister(Program $register): static
    {
        $this->registers->removeElement($register);

        return $this;
    }

    /**
     * @return Collection<int, Program>
     */
    public function getCreatePrograms(): Collection
    {
        return $this->createPrograms;
    }

    public function addCreateProgram(Program $createProgram): static
    {
        if (!$this->createPrograms->contains($createProgram)) {
            $this->createPrograms->add($createProgram);
            $createProgram->setUser($this);
        }

        return $this;
    }

    public function removeCreateProgram(Program $createProgram): static
    {
        if ($this->createPrograms->removeElement($createProgram)) {
            // set the owning side to null (unless already changed)
            if ($createProgram->getUser() === $this) {
                $createProgram->setUser(null);
            }
        }

        return $this;
    }
}
