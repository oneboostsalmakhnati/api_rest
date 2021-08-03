<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CabinetRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CabinetRepository::class)
 * @ApiResource(normalizationContext={"groups"={"cabinet:read"}},
 *     denormalizationContext={"groups"={"cabinet:write"}})
 * @UniqueEntity(
 * fields={"email"},
 * message="il existe deja un email {{value}},veuillez saisir un email")
 */
class Cabinet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("cabinet:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cabinet:read", "cabinet:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cabinet:read", "cabinet:write"})
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cabinet:read", "cabinet:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cabinet:read", "cabinet:write"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cabinet:read", "cabinet:write"})
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="cabinet")
     * @Groups("cabinet:read")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCabinet($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCabinet() === $this) {
                $user->setCabinet(null);
            }
        }

        return $this;
    }
}
