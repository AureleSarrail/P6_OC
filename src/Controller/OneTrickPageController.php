<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\TrickRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function index(Trick $trick, Request $request, ObjectManager $manager, UserRepository $repository)
    {


        $commentForm = $this->createForm(CommentFormType::class);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && ($commentForm->isValid())) {

            $comment = $commentForm->getData();

            $comment->setTrick($trick)
                ->setCreatedAt(new \DateTime())
                ->setUser($repository->find(rand(1,5)));

            //$this->getUser()

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('show', ['id' => $trick->getId()]);

        }

        return $this->render('one_trick_page/index.html.twig', [
            'commentForm' => $commentForm->createView(),
            'trick' => $trick
        ]);
    }
}
