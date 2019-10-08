<?php

namespace App\Controller;

use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewTrickController extends AbstractController
{
    /**
     * @Route("/newTrick", name="new_trick")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {


        $trickForm = $this->createForm(TrickType::class);

        $trickForm->handleRequest($request);

        if($trickForm->isSubmitted() && $trickForm->isValid()){
            $trick = $trickForm->getData();
            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success','Figure ajoutée');
            return $this->redirectToRoute('update_trick',[
                'id'=> $trick->getId()
            ]);
        }


        return $this->render('new_trick/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
