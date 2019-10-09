<?php

namespace App\Controller;

use App\Form\TrickType;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    /**
     * @Route("/update/{id}", name="update_trick")
     */
    public function index($id, TrickRepository $trickRepo)
    {

        $trickForm = $this->createForm(TrickType::class);

        return $this->render('update_trick/index.html.twig', [
            'trick' => $trickRepo->oneTrickById($id),
            'trickForm' => $trickForm->createView()
        ]);
    }
}
