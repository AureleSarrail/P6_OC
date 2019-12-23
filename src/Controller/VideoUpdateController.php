<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\AddVideoFormType;
use App\Service\UpdateVideoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoUpdateController extends AbstractController
{
    /**
     * @Route("/video/update/{id}", name="video_update")
     * @Security("has_role('ROLE_USER')")
     * @param Video $video
     * @param Request $request
     * @param UpdateVideoService $service
     * @return RedirectResponse|Response
     */
    public function index(Video $video, Request $request, UpdateVideoService $service)
    {
        $addVideoForm = $this->createForm(AddVideoFormType::class);

        $addVideoForm->handleRequest($request);

        if ($addVideoForm->isSubmitted() && $addVideoForm->isValid()) {

            $trick = $service->updateVideo($addVideoForm->getData(),$video);

            $this->addFlash('success', 'Vidéo bien ajoutée');

            //redirection vers la page de mise à jour de la trick
            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }

        return $this->render('video_update/index.html.twig', ['addVideo' => $addVideoForm->createView(),
            'video' => $video
        ]);
    }
}

