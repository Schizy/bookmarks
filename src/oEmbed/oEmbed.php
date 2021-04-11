<?php

namespace App\oEmbed;

use App\Entity\Gif;
use App\Entity\Link;
use App\Entity\Photo;
use App\Entity\Video;

class oEmbed
{
    const HYDRATORS = [
        Video::class => VideoEmbedHydrator::class,
        Photo::class => PhotoEmbedHydrator::class,
        Gif::class => GifEmbedHydrator::class,
    ];

    public function hydrateLinkEntity(Link $link)
    {
        $linkType = get_class($link);
        if (!array_key_exists($linkType, self::HYDRATORS)) {
            throw new \LogicException("No EmbedHydrator found for the class : " . $linkType);
        }

        $hydrator = self::HYDRATORS[$linkType];

        return (new $hydrator($link))->fetchData();
    }
}
