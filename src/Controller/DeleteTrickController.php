<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickController extends AbstractController
{
    /**
     * @Route("/delete/{id}", name="deleteTrick")
     */
    public function index($trick, $id)
    {
        return $this->render('delete_trick/index.html.twig', [
            'controller_name' => 'DeleteTrickController',
        ]);
    }
}
