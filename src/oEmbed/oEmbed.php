<?php

namespace App\oEmbed;

use App\Entity\Link;
use App\Entity\Photo;
use App\Entity\Video;
use Embed\Embed;

class oEmbed
{
    protected $data = [];

    const HYDRATORS = [
        Video::class => VideoEmbedHydrator::class,
        Photo::class => PhotoEmbedHydrator::class,
    ];

    public function hydrateLinkEntity(Link $link)
    {
        $linkType = get_class($link);
        if (!array_key_exists($linkType, self::HYDRATORS)) {
            throw new \LogicException("No EmbedHydrator found for the class : " . $linkType);
        }

        //We determine wich hydrator will do the job
        $class = self::HYDRATORS[$linkType];
        $hydrator = new $class;

        //If we want to sanitize the URL, we can
        $this->setDataFromUrl($hydrator->sanitizeUrl($link->getUrl()));

        //In the case there would be no data, we return without errors
        //The user still can enter the values in JSON
        if (!$this->data) {
            return;
        }

        //We hydrate the common fields first
        $this->hydrateCommonFields($link);

        //Then we let the hydrator hydrate only the custom parameters
        return $hydrator->setData($this->data)->hydrate($link);
    }

    /**
     * Can be override to sanitize any type of URL
     */
    protected function sanitizeUrl($url): string
    {
        return $url;
    }

    protected function setDataFromUrl($url)
    {
        $this->data = (new Embed())->get($url)->getOEmbed()->all();
    }

    protected function setData(array $data = [])
    {
        $this->data = $data;

        return $this;
    }

    protected function hydrateCommonFields(Link $link)
    {
        $link
            ->setTitle($this->data['title'])
            ->setAuthor($this->data['author_name']);
    }

    protected function hydrate(Link $link)
    {
    }
}
