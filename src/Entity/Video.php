<?php

namespace App\Entity;

use App\Entity\Traits\RectangularMediaTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Video extends Link
{
    use RectangularMediaTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
