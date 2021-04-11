<?php

namespace App\Normalizer;

use App\Entity\Keyword;
use App\Repository\KeyWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class KeywordsDenormalizer implements DenormalizerInterface
{
    private EntityManagerInterface $em;
    private KeyWordRepository $repository;

    public function __construct(EntityManagerInterface $em, KeyWordRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $existingKeywords = $this->repository->getFromNames($data);
        if (count($existingKeywords) === count($data)) {
            return $existingKeywords;
        }

        //There are some new ones!
        $newKeywords = [];
        foreach ($data as $i => $name) {
            if (!array_key_exists($name, $existingKeywords)) {
                ${'keyword' . $i} = (new Keyword())->setName($name);
                $this->em->persist(${'keyword' . $i});
                $newKeywords[] = ${'keyword' . $i};
            }
        }

        return $newKeywords + $existingKeywords;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && $type === Keyword::class . '[]';
    }
}
