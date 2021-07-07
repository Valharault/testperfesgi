<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
#[ApiResource(attributes: ['pagination_items_per_page' => 10])]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'title' => 'exact', 'story' => 'partial'])]
class Film
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $story;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $additionnalInformation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Producer::class, mappedBy="films")
     */
    private $producers;

    /**
     * @ORM\ManyToOne(targetEntity=FilmGenres::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=FilmCertificate::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $certificates;

    /**
     * @ORM\OneToMany(targetEntity=ActorRole::class, mappedBy="film")
     */
    private $roles;

    public function __construct()
    {
        $this->producers = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAdditionnalInformation(): ?string
    {
        return $this->additionnalInformation;
    }

    public function setAdditionnalInformation(?string $additionnalInformation): self
    {
        $this->additionnalInformation = $additionnalInformation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Producer[]
     */
    public function getProducers(): Collection
    {
        return $this->producers;
    }

    public function addProducer(Producer $producer): self
    {
        if (!$this->producers->contains($producer)) {
            $this->producers[] = $producer;
            $producer->addFilm($this);
        }

        return $this;
    }

    public function removeProducer(Producer $producer): self
    {
        if ($this->producers->removeElement($producer)) {
            $producer->removeFilm($this);
        }

        return $this;
    }

    public function getGenre(): ?FilmGenres
    {
        return $this->genre;
    }

    public function setGenre(?FilmGenres $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCertificates(): ?FilmCertificate
    {
        return $this->certificates;
    }

    public function setCertificates(?FilmCertificate $certificates): self
    {
        $this->certificates = $certificates;

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
            $role->setFilm($this);
        }

        return $this;
    }

    public function removeRole(ActorRole $role): self
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getFilm() === $this) {
                $role->setFilm(null);
            }
        }

        return $this;
    }
}
