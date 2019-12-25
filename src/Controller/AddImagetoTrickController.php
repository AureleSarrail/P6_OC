<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\AddImageFormType;
use App\Service\AddOneImageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddImagetoTrickController extends AbstractController
{
    /**
     * @Route("/addimage/{id}", name="add_image_to_trick")
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param Trick $trick
     * @param AddOneImageService $service
     * @return RedirectResponse|Response
     */
    public function index(Request $request, Trick $trick, AddOneImageService $service)
    {
        $addImage = $this->createForm(AddImageFormType::class);

        $addImage->handleRequest($request);

        if ($addImage->isSubmitted() && $addImage->isValid()) {
            $service->addOneImage($addImage->getData(), $trick);

            $this->addFlash('success', 'Image bien ajoutée');

            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }


        return $this->render('add_imageto_trick/index.html.twig', [
            'addImage' => $addImage->createView(),
            'trick' => $trick
        ]);
    }
}
