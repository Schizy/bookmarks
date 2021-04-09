<?php

namespace App\Entity;

use App\Entity\Traits\RectangularMediaTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Photo extends Link
{
    use RectangularMediaTrait;
}
