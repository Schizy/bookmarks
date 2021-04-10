<?php

namespace App\oEmbed;

use App\Entity\Link;

class VideoEmbedHydrator extends oEmbed
{
    public function hydrate(Link $link)
    {
        $link
            ->setDuration($this->data['duration'])
            ->setWidth($this->data['width'])
            ->setHeight($this->data['height']);
    }
}
