<?php

namespace App\oEmbed;

class GifEmbedHydrator extends oEmbedHydrator
{
    protected function hydrate()
    {

        $this->link
            ->setIsCat(false !== stripos($this->data['title'], 'cat'));
    }
}
