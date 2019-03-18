<?php
namespace App\Common\EntityTrait;

use Doctrine\ORM\Mapping as ORM;

trait EntityExpirableTrait
{
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expiredAt;

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    public function isExpired(): bool
    {
        return $this->expiredAt > time();
    }
}