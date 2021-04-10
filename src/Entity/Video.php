<?php

namespace App\Entity;

use App\Entity\Traits\RectangularMediaTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Video extends Link
{
    use RectangularMediaTrait;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    private $duration;

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration($duration): self
    {
        $this->duration = (int)$duration;

        return $this;
    }
}
