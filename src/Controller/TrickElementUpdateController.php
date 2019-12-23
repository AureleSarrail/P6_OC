<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickUpdateType;
use App\Repository\TrickRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickElementUpdateController extends AbstractController
{
    /**
     * @Route("/trickElementUpdate/{id}", name="trick_element_update")
     * @Security("has_role('ROLE_USER')")
     * @param Trick $trick
     * @param Request $request
     * @param TrickRepository $trickRepository
     * @return RedirectResponse|Response
     */
    public function index(Trick $trick, Request $request, TrickRepository $trickRepository)
    {

        $trickForm = $this->createForm(TrickUpdateType::class, $trick);

        $trickForm->handleRequest($request);

        if ($trickForm->isSubmitted() && $trickForm->isValid()) {
            $trickRepository->save($trick);

            $this->addFlash('success', 'La tricks a bien été mise à jour');

            return $this->redirectToRoute('update_trick', [
                'slug' => $trick->getSlug()
            ]);
        }


        return $this->render('trick_element_update/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
