<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
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
     * @ORM\OneToMany(targetEntity="App\Entity\AdvertSkill", mappedBy="skill")
     */
    private $advertSkill;

    public function __construct()
    {
        $this->advertSkill = new ArrayCollection();
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
     * @return Collection|AdvertSkill[]
     */
    public function getAdvertSkill(): Collection
    {
        return $this->advertSkill;
    }

    public function addAdvertSkill(AdvertSkill $advertSkill): self
    {
        if (!$this->advertSkill->contains($advertSkill)) {
            $this->advertSkill[] = $advertSkill;
            $advertSkill->setSkill($this);
        }

        return $this;
    }

    public function removeAdvertSkill(AdvertSkill $advertSkill): self
    {
        if ($this->advertSkill->contains($advertSkill)) {
            $this->advertSkill->removeElement($advertSkill);
            // set the owning side to null (unless already changed)
            if ($advertSkill->getSkill() === $this) {
                $advertSkill->setSkill(null);
            }
        }

        return $this;
    }
}
