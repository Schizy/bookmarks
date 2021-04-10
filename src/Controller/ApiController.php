<?php

namespace App\Controller;

use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class ApiController extends AbstractController
{
    protected ValidatorInterface $validator;
    protected EntityManagerInterface $em;
    protected SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->em = $em;
        $this->serializer = $serializer;
    }

    protected function persist(Link $entity): Link
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    protected function remove(Link $entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    protected function validate(Link $entity): ?ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($entity);
        return $errors->count() ? $errors : null;
    }

    protected function deserialize(Request $request, $class, $entityToPopulate = null)
    {
        return $this->serializer->deserialize($request->getContent(), $class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $entityToPopulate,
            AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
        ]);
    }

    protected function badRequest($errors): JsonResponse
    {
        return $this->json($errors, Response::HTTP_BAD_REQUEST);
    }
}
