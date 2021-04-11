<?php

namespace App\Normalizer;

use App\Entity\Keyword;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class KeywordNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return $object->getName();
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Keyword;
    }
}
