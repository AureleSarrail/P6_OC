<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickController extends AbstractController
{
    /**
     * @Route("/delete_trick/{id}", name="deleteTrick", options={"expose" = true})
     */
    public function index(EntityManagerInterface $manager, Trick $trick)
    {

        $manager->remove($trick);
        $manager->flush();

        $this->addFlash('success', 'La trick a bien été supprimée.');

        return $this->redirectToRoute('home');
    }
}
