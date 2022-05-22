<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $verifier;

    #[ORM\Column(type: 'boolean')]
    private $disponible;

    #[ORM\ManyToMany(targetEntity: Tags::class)]
    private $tags;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Images::class, orphanRemoval: true)]
    private $galerie;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->galerie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isVerifier(): ?bool
    {
        return $this->verifier;
    }

    public function setVerifier(bool $verifier): self
    {
        $this->verifier = $verifier;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getGalerie(): Collection
    {
        return $this->galerie;
    }

    public function addGalerie(Images $galerie): self
    {
        if (!$this->galerie->contains($galerie)) {
            $this->galerie[] = $galerie;
            $galerie->setArtist($this);
        }

        return $this;
    }

    public function removeGalerie(Images $galerie): self
    {
        if ($this->galerie->removeElement($galerie)) {
            // set the owning side to null (unless already changed)
            if ($galerie->getArtist() === $this) {
                $galerie->setArtist(null);
            }
        }

        return $this;
    }
}
