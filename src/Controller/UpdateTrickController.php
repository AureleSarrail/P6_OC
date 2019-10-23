<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    /**
     * @Route("/updateTrick/{slug}", name="update_trick")
     */
    public function index(Trick $trick, TrickRepository $trickRepo)
    {

        $trickForm = $this->createForm(TrickType::class);

        return $this->render('update_trick/index.html.twig', [
            'trick' => $trick,
            'trickForm' => $trickForm->createView()
        ]);
    }
}
