<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickController extends AbstractController
{
    /**
     * @Route("/delete_trick/{id}", name="deleteTrick", options={"expose" = true})
     * @Security("has_role('ROLE_USER')")
     * @param EntityManagerInterface $manager
     * @param Trick $trick
     * @return RedirectResponse
     */
    public function index(EntityManagerInterface $manager, Trick $trick)
    {

        $manager->remove($trick);
        $manager->flush();

        $this->addFlash('success', 'La trick a bien été supprimée.');

        return $this->redirectToRoute('home');
    }
}
