<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    /**
     * @Route("/update", name="updateTrick")
     */
    public function index()
    {
        return $this->render('update_trick/index.html.twig', [
            'controller_name' => 'UpdateTrickController',
        ]);
    }
}
