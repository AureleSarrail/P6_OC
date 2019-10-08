<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Trick;
use App\Form\AddImageFormType;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddImagetoTrickController extends AbstractController
{
    /**
     * @Route("/addimage/{id}", name="add_image_to_trick")
     */
    public function index(Request $request, Trick $trick, EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {

        $addImage = $this->createForm(AddImageFormType::class);

        $addImage->handleRequest($request);

        if ($addImage->isSubmitted() && $addImage->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $addImage->getData()['file'];
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadImage($uploadedFile);
            }
            $image = new Image();
            $image->setUrl($newFilename);
            $trick->addImage($image);

            $em->persist($image);
            $em->flush();

            $this->addFlash('success', 'Image bien ajoutée');

            return $this->redirectToRoute('update_trick', [
                'id' => $trick->getId()
            ]);

        }


        return $this->render('add_imageto_trick/index.html.twig', [
            'addImage' => $addImage->createView(),
            'trick' => $trick
        ]);
    }
}
