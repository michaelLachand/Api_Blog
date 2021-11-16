<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

trait Timestapable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column (type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;


    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }




}
