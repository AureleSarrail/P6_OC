<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show_one_trick")
     * @param Trick $trick
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserRepository $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function index(Trick $trick, Request $request, EntityManagerInterface $manager, UserRepository $user)
    {


        $commentForm = $this->createForm(CommentFormType::class);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && ($commentForm->isValid())) {

            $comment = $commentForm->getData();

            $comment->setTrick($trick)
                ->setCreatedAt(new \DateTime())
                ->setUser($user->find(rand(1, 5)));

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
