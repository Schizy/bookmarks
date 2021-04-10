<?php

namespace App\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class BadRequestNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        $badRequest = ['status' => 400];

        foreach ($object as $violation) {
            $badRequest['errors'][] = [
                'property' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        return $badRequest;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ConstraintViolationList;
    }
}
