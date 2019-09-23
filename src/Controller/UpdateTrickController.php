<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    /**
     * @Route("/update/{id}", name="updateTrick")
     */
    public function index($id, TrickRepository $trickRepo)
    {

        return $this->render('update_trick/index.html.twig', [
            'Trick' => $trickRepo->oneTrickById($id)
        ]);
    }
}