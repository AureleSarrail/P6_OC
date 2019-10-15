<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ForgottenPasswordController extends AbstractController
{
    /**
     * @Route("/forgotten/password", name="forgotten_password")
     */
    public function index()
    {
        return $this->render('forgotten_password/index.html.twig', [
            'controller_name' => 'ForgottenPasswordController',
        ]);
    }
}
