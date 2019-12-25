<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\AddVideoFormType;
use App\Service\AddOneVideoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddVideotoTrickController extends AbstractController
{
    /**
     * @Route("/addVideo/{id}", name="add_video_to_trick")
     * @Security("has_role('ROLE_USER')")
     * @param Trick $trick
     * @param Request $request
     * @param AddOneVideoService $service
     * @return RedirectResponse|Response
     */
    public function index(Trick $trick, Request $request, AddOneVideoService $service)
    {

        $addVideo = $this->createForm(AddVideoFormType::class);

        $addVideo->handleRequest($request);

        if ($addVideo->isSubmitted() && $addVideo->isValid()) {
            $service->addOneVideo($addVideo->getData(), $trick);

            //message si ok
            $this->addFlash('success', 'Vidéo bien ajoutée');

            //redirection vers la page de mise à jour de la trick
            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }

        return $this->render('add_videoto_trick/index.html.twig', [
            'addVideo' => $addVideo->createView()
        ]);
    }
}
