<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActorRepository::class)
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=ActorRole::class, mappedBy="actor")
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return Collection|ActorRole[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(ActorRole $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setActor($this);
        }

        return $this;
    }

    public function removeRole(ActorRole $role): self
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getActor() === $this) {
                $role->setActor(null);
            }
        }

        return $this;
    }
}
