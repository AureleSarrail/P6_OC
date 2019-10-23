<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrickElementUpdateController extends AbstractController
{
    /**
     * @Route("/trickElementUpdate/{id}", name="trick_element_update")
     */
    public function index(Trick $trick, Request $request, EntityManagerInterface $em)
    {

        $trickForm = $this->createForm(TrickType::class, $trick);

        $trickForm->handleRequest($request);

        if ($trickForm->isSubmitted() && $trickForm->isValid())
        {
            $em->flush();

            $this->addFlash('success','La tricks a bien été mise à jour');

            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }


        return $this->render('trick_element_update/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
