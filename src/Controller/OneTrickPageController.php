<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Service\AddCommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/trick/{slug}", name="show_one_trick", options={"expose" = true})
     * @param Trick $trick
     * @param Request $request
     * @param AddCommentService $service
     * @return RedirectResponse|Response
     */
    public function index(Trick $trick, Request $request, AddCommentService $service)
    {
        $commentForm = $this->createForm(CommentFormType::class);

        $commentForm->handleRequest($request);

        $commentPageMax = $trick->getCommentsMaxPage();

        if ($commentForm->isSubmitted() && ($commentForm->isValid())) {

            $service->addComment($commentForm->getData(), $trick);

            return $this->redirectToRoute('show_one_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('one_trick_page/index.html.twig', [
            'commentForm' => $commentForm->createView(),
            'trick' => $trick,
            'pageMax' => $commentPageMax
        ]);
    }
}
