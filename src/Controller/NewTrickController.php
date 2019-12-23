<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Service\NewTrickService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewTrickController extends AbstractController
{
    /**
     * @Route("/newTrick", name="new_trick")
     * @Security("has_role('ROLE_USER')")
     * @param Request $request
     * @param NewTrickService $service
     * @return RedirectResponse|Response
     */
    public function index(Request $request, NewTrickService $service)
    {
        $trickForm = $this->createForm(TrickType::class);

        $trickForm->handleRequest($request);

        if ($trickForm->isSubmitted() && $trickForm->isValid()) {

            /** @var Trick $trick */
            $trick = $service->newTrick($trickForm->getData());

            $this->addFlash('success', 'Figure ajoutée');

            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }


        return $this->render('new_trick/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
