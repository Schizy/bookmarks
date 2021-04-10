<?php

namespace App\oEmbed;

use App\Entity\Link;
use App\Entity\Video;
use Embed\Embed;
use Symfony\Component\Process\Exception\LogicException;

class oEmbed
{
    const HYDRATORS = [
        Video::class => VideoEmbedHydrator::class
    ];

    /**
     * Generic parent class.
     */
    public function getFromUrl($url): array
    {
        return (new Embed())->get($url)->getOEmbed()->all();
    }

    public function hydrateLinkEntity(Link $link)
    {
        $linkTpe = get_class($link);

        if (array_key_exists($linkTpe, self::HYDRATORS)) {
            $hydrator = self::HYDRATORS[$linkTpe];

            return (new $hydrator)->hydrateLinkEntity($link);
        }

        throw new LogicException("No EmbedHydrator found for the class : " . $linkTpe);
    }
}
