<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $advertAtDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\person", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\advert", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

    public function __construct()
    {
        $this->advertAtDate  = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAdvertAtDate(): ?\DateTimeInterface
    {
        return $this->advertAtDate;
    }

    public function setAdvertAtDate(\DateTimeInterface $advertAtDate): self
    {
        $this->advertAtDate = $advertAtDate;

        return $this;
    }

    public function getAuthor(): ?person
    {
        return $this->author;
    }

    public function setAuthor(?person $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAdvert(): ?advert
    {
        return $this->advert;
    }

    public function setAdvert(?advert $advert): self
    {
        $this->advert = $advert;

        return $this;
    }
}
