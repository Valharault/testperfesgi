<?php

namespace App\Entity;

use App\Repository\ActorRoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActorRoleRepository::class)
 */
class ActorRole
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
    private $characterName;

    /**
     * @ORM\Column(type="text")
     */
    private $characterDescription;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="roles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity=Actor::class, inversedBy="roles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $actor;

    /**
     * @ORM\ManyToOne(targetEntity=RoleType::class, inversedBy="role")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roleType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacterName(): ?string
    {
        return $this->characterName;
    }

    public function setCharacterName(string $characterName): self
    {
        $this->characterName = $characterName;

        return $this;
    }

    public function getCharacterDescription(): ?string
    {
        return $this->characterDescription;
    }

    public function setCharacterDescription(string $characterDescription): self
    {
        $this->characterDescription = $characterDescription;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): self
    {
        $this->actor = $actor;

        return $this;
    }

    public function getRoleType(): ?RoleType
    {
        return $this->roleType;
    }

    public function setRoleType(?RoleType $roleType): self
    {
        $this->roleType = $roleType;

        return $this;
    }
}
