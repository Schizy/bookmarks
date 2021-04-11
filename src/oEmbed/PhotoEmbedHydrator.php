<?php

namespace App\oEmbed;

class PhotoEmbedHydrator extends oEmbedHydrator
{
    protected function sanitizeUrl($url): string
    {
        //We need to add the www for oEmbed to work, probably because there is a redirection otherwise
        return str_ireplace('https://flickr.com/', 'https://www.flickr.com/', $url);
    }

    protected function hydrate()
    {
        $this->link
            ->setWidth($this->data['width'])
            ->setHeight($this->data['height']);
    }
}
