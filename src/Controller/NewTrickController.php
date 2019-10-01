<?php

namespace App\Controller;

use App\Form\AddImageFormType;
use App\Form\AddVideoFormType;
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
        $addImage = $this->createForm(AddImageFormType::class);
        $addVideo = $this->createForm(AddVideoFormType::class);

        return $this->render('new_trick/index.html.twig', [
            'trickForm' => $trickForm->createView(),
            'addImage' => $addImage->createView(),
            'addVideo' => $addVideo->createView()
        ]);
    }
}
