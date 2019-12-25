<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\AddImageFormType;
use App\Service\UpdateImageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageUpdateController extends AbstractController
{
    /**
     * @Route("/image_update/{id}", name="image_update")
     * @Security("has_role('ROLE_USER')")
     * @param Image $image
     * @param Request $request
     * @param UpdateImageService $service
     * @return RedirectResponse|Response
     */
    public function index(Image $image, Request $request, UpdateImageService $service)
    {
        $imageForm = $this->createForm(AddImageFormType::class);

        $imageForm->handleRequest($request);

        if ($imageForm->isSubmitted() && $imageForm->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $service->updateImage($imageForm['file']->getData(), $image);

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
