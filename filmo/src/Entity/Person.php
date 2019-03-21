<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Movies", mappedBy="actors")
     */
    private $movies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Movies", mappedBy="director")
     */
    private $real_movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->real_movies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Movies[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movies $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addActor($this);
        }

        return $this;
    }

    public function removeMovie(Movies $movie): self
    {
        if ($this->movies->contains($movie)) {
            $this->movies->removeElement($movie);
            $movie->removeActor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Movies[]
     */
    public function getRealMovies(): Collection
    {
        return $this->real_movies;
    }

    public function addRealMovie(Movies $realMovie): self
    {
        if (!$this->real_movies->contains($realMovie)) {
            $this->real_movies[] = $realMovie;
            $realMovie->setDirector($this);
        }

        return $this;
    }

    public function removeRealMovie(Movies $realMovie): self
    {
        if ($this->real_movies->contains($realMovie)) {
            $this->real_movies->removeElement($realMovie);
            // set the owning side to null (unless already changed)
            if ($realMovie->getDirector() === $this) {
                $realMovie->setDirector(null);
            }
        }

        return $this;
    }
}
