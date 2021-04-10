<?php

namespace App\Factory;

use App\Entity\Photo;
use App\Entity\Video;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class LinkFactory
{
    const LINK_TYPES = [
        'photo' => Photo::class,
        'video' => Video::class,
    ];

    const URL_TYPES = [
        'vimeo.com' => 'video',
//        'youtube.com' => 'video', //We could do that too!
        'flickr.com' => 'photo',
    ];

    public static function guessTypeFromJson(string $body): ?string
    {
        $json = json_decode($body, true);
        if (null === $json) {
            throw new NotEncodableValueException('Json syntax error.');
        }

        if (!array_key_exists('url', $json)) {
            return null;
        }

        //We guess from the URL
        $url = $json['url'];
        foreach (self::URL_TYPES as $urlType => $type) {
            if (false !== stripos($url, $urlType)) {
                return $type;
            }
        }

        return null;
    }
}
