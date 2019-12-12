<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\AddImageFormType;
use App\Repository\ImageRepository;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageUpdateController extends AbstractController
{
    /**
     * @Route("/image_update/{id}", name="image_update")
     */
    public function index(Image $image, ImageRepository $imageRepository, Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $em)
    {
        $imageForm = $this->createForm(AddImageFormType::class);

        $imageForm->handleRequest($request);

        if ($imageForm->isSubmitted() && $imageForm->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $imageForm['file']->getData();
            $newFilename = $uploaderHelper->uploadImage($uploadedFile,$image->getUrl());


            $image->setUrl($newFilename);

            $em->persist($image);
            $em->flush();

            $this->addFlash('success', 'Image bien ajoutée');

            return $this->redirectToRoute('update_trick', [
                'slug' => $image->getTrick()->getSlug()
            ]);

        }

        return $this->render('image_update/index.html.twig', [
            'imageForm' => $imageForm->createView()
        ]);
    }
}
