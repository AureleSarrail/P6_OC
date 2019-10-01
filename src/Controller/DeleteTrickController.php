<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickController extends AbstractController
{
    /**
     * @Route("/delete/{id}", name="deleteTrick")
     */
    public function index(EntityManagerInterface $manager, Trick $trick)
    {

        $manager->remove($trick);
        $manager->flush();

        return $this->redirectToRoute('home');
    }
}
