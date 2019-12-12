<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewTrickController extends AbstractController
{
    /**
     * @Route("/newTrick", name="new_trick")
     */
    public function index(Request $request, EntityManagerInterface $entityManager,UploaderHelper $uploaderHelper)
    {


        $trickForm = $this->createForm(TrickType::class);

        $trickForm->handleRequest($request);

        if($trickForm->isSubmitted() && $trickForm->isValid()){
            $trick = $trickForm->getData();

            for($i=0; $i < $trick->getImages()->count(); $i++) {
                $newFilename = $uploaderHelper->uploadImage($trick->getImages()[$i]->getFile());
                $trick->getImages()[$i]->setUrl($newFilename);
            }

            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success','Figure ajoutée');
            return $this->redirectToRoute('update_trick',[
                'slug'=> $trick->getSlug()
            ]);
        }


        return $this->render('new_trick/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
