<?php


namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adds created at and updated at timestamps to entities. Requires that entities are
 * marked with the HasLifecycleCallbacks annotation.
 *
 * @ORM\HasLifecycleCallbacks
 */

trait Timestampable
{

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}


