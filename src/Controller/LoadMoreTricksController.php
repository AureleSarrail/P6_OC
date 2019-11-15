<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoadMoreTricksController extends AbstractController
{
    /**
     * @Route("/load_more_tricks", name="load_more_tricks")
     */
    public function index(TrickRepository $trickRepository, Request $request, SerializerInterface $serializer)
    {
        if ($request->isXmlHttpRequest()) {
            $page = $request->request->get('page');

            $tricks = $trickRepository->TricksForLoadMore($page);

            $nbPage = $trickRepository->countMaxPage();

//            $response = new JsonResponse(array(
//                'tricks' => $tricks
//            ));

            $json = $serializer->serialize($tricks, 'json', ['groups'=> ['public']]);
            return new JsonResponse($json);
        }
        else{
            return new JsonResponse(array(
                'status' => 'Error',
                'message' => 'Error'),
                400);
        }
//



    }
}
