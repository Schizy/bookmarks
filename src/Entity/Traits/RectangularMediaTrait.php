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
    protected $height;

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth($width): self
    {
        $this->width = (int)$width;
        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight($height): self
    {
        $this->height = (int)$height;
        return $this;
    }
}
