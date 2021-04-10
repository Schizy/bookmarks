<?php

namespace App\Controller;

use App\Entity\Link;
use App\Factory\LinkFactory;
use App\oEmbed\oEmbed;
use App\Repository\LinkRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/links", name="link")
 */
class LinkController extends ApiController
{
    /**
     * @Route("", name="app_links_list", methods={"GET"})
     */
    public function list(LinkRepository $linkRepository): Response
    {
        return $this->json($linkRepository->findAll());
    }

    /**
     * @Route("", name="app_links_create", methods={"POST"})
     */
    public function create(Request $request, oEmbed $embed): Response
    {
        $type = $this->guessTypeOrReturnBadRequest($request);
        $link = $this->deserialize($request, LinkFactory::LINK_TYPES[$type]);
        $embed->hydrateLinkEntity($link);

        if ($errors = $this->validate($link)) {
            return $this->badRequest($errors);
        }

        return $this->json($this->persist($link), Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", name="app_links_getOne", methods={"GET"})
     */
    public function getOne(LinkRepository $linkRepository, $id): Response
    {
        return $this->json($this->findOne($linkRepository, $id));
    }

    /**
     * @Route("/{id}", name="app_links_update", methods={"PUT", "PATCH"})
     */
    public function update(LinkRepository $linkRepository, $id, Request $request): Response
    {
        $link = $this->findOne($linkRepository, $id);
        $initialUrl = $link->getUrl();

        $link = $this->deserialize($request, Link::class, $link);

        if ($errors = $this->validate($link)) {
            return $this->badRequest($errors);
        }

        if ($initialUrl !== $link->getUrl()) {
            throw new BadRequestHttpException("The URL cannot be changed; make a new one instead");
        }

        $this->em->flush();

        return $this->json($link);
    }

    /**
     * @Route("/{id}", name="app_links_delete", methods={"DELETE"})
     */
    public function delete(LinkRepository $linkRepository, $id): Response
    {
        $this->remove($this->findOne($linkRepository, $id));

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Because of the CTI on Link Entity we need to fetch it manually
     * We could probably install extra-bundle and do it with ParamConverter annotations
     */
    private function findOne(LinkRepository $linkRepository, $id): Link
    {
        if (!$link = $linkRepository->find($id)) {
            throw new NotFoundHttpException;
        }

        return $link;
    }

    private function guessTypeOrReturnBadRequest(Request $request): string
    {
        if (!$type = LinkFactory::guessTypeFromJson($request->getContent())) {
            throw new BadRequestHttpException("Unknown Bookmark's URL type");
        }

        return $type;
    }
}
