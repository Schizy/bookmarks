<?php

namespace App\oEmbed;

use App\Entity\Link;
use Embed\Embed;

abstract class oEmbedHydrator
{
    protected $data = [];
    protected $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function fetchData()
    {
        $url = $this->sanitizeUrl($this->link->getUrl());
        $this->data = (new Embed())->get($url)->getOEmbed()->all();

        //In the case there would be no data, we return without errors
        //The user still can enter the values in JSON
        if (!$this->data) {
            return;
        }

        $this->hydrateCommonFields();
        $this->hydrate();
    }

    /**
     * Can be overridden to sanitize any type of URL
     */
    protected function sanitizeUrl($url): string
    {
        return $url;
    }

    /**
     * Must be overridden to hydrate custom properties
     */
    abstract protected function hydrate();

    private function hydrateCommonFields()
    {
        $this->link
            ->setTitle($this->data['title'])
            ->setAuthor($this->data['author_name']);
    }
}
