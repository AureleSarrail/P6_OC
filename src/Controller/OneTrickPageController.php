<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function index($id, TrickRepository $repo)
    {

        $comment = new Comment();

        $commentForm = $this->createForm(CommentFormType::class, $comment);

        return $this->render('one_trick_page/index.html.twig', [
            'commentForm' => $commentForm->createView(),
            'trick' => $repo->oneTrickById($id)
        ]);
    }
}
