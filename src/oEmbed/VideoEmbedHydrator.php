<?php

namespace App\oEmbed;

class VideoEmbedHydrator extends oEmbedHydrator
{
    protected function hydrate()
    {
        $this->link
            ->setDuration($this->data['duration'])
            ->setWidth($this->data['width'])
            ->setHeight($this->data['height']);
    }
}
