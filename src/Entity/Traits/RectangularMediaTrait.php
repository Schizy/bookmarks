<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait RectangularMediaTrait
{
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    protected $width;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    protected $length;

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth($width): self
    {
        $this->width = (int)$width;
        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength($length): self
    {
        $this->length = (int)$length;
        return $this;
    }
}
