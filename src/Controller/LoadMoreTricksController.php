<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\Service\LoadMoreTricksRepresentation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoadMoreTricksController extends AbstractController
{
    /**
     * @Route("/load_more_tricks", name="load_more_tricks")
     * @param TrickRepository $trickRepository
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param LoadMoreTricksRepresentation $loadMoreTricksRepresentation
     * @return JsonResponse
     */
    public function index(
        TrickRepository $trickRepository,
        Request $request,
        SerializerInterface $serializer,
        LoadMoreTricksRepresentation $loadMoreTricksRepresentation
    ) {
        if ($request->isXmlHttpRequest()) {
            $page = $request->request->get('page');

            $tricks = $trickRepository->tricksForLoadMore($page);

            $represent = $loadMoreTricksRepresentation($tricks);

            $nbPage = $trickRepository->countMaxPage();

            $json = $serializer->serialize(array($represent, $nbPage), 'json', ['groups' => ['public']]);

            return new JsonResponse($json);
        } else {
            return new JsonResponse(array(
                'status' => 'Error',
                'message' => 'Error'
            ),
                400);
        }
    }
}
