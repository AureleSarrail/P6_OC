<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoadMoreCommentController extends AbstractController
{
    /**
     * @Route("/tricks/{slug}/load-more-comment", name="load_more_comment")
     */
    public function index(Trick $trick,CommentRepository $repository, Request $request, SerializerInterface $serializer)
    {
        if ($request->isXmlHttpRequest()) {
            $page = $request->query->get('page', 1);

            $comments = $repository->loadMoreComment($trick,$page);

            $json = $serializer->serialize($comments,'json', ['groups'=> 'commentPublic']);

            return new JsonResponse($json);
        }

    }
}
