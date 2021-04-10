<?php

namespace App\oEmbed;

use App\Entity\Link;

class PhotoEmbedHydrator extends oEmbed
{
    protected function sanitizeUrl($url): string
    {
        //We need to add the www for oEmbed to work, probably because there is a redirection otherwise
        return str_ireplace('https://flickr.com/', 'https://www.flickr.com/', $url);
    }

    public function hydrate(Link $link)
    {
        $link
            ->setWidth($this->data['width'])
            ->setHeight($this->data['height']);
    }
}
