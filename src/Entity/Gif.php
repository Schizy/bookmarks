<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Gif extends Link
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $isCat;

    public function getIsCat(): bool
    {
        return $this->isCat;
    }

    public function setIsCat($isCat): self
    {
        $this->isCat = $isCat;
        return $this;
    }
}
