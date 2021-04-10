<?php

namespace App\oEmbed;

use App\Entity\Link;

class VideoEmbedHydrator extends oEmbed
{
    public function hydrateLinkEntity(Link $link)
    {
        //We can sanitize the URL if needed here
        if (!$data = $this->getFromUrl($link->getUrl())) {
            //We return without errors, the user still can enter the values in JSON
            return;
        }

        $link
            ->setTitle($data['title'])
            ->setAuthor($data['author_name'])
            ->setDuration($data['duration'])
            ->setWidth($data['width'])
            ->setHeight($data['height']);
    }
}
