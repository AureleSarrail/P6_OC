<?php

namespace App\Controller;

use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewTrickController extends AbstractController
{
    /**
     * @Route("/newTrick", name="new_trick")
     */
    public function index()
    {

        $trickForm = $this->createForm(TrickType::class);

        return $this->render('new_trick/index.html.twig', [
            'trickForm' => $trickForm->createView()
        ]);
    }
}
