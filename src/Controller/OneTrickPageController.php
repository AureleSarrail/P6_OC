<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/show/{$id)", name="show")
     */
    public function index()
    {
        return $this->render('one_trick_page/index.html.twig', [
            'controller_name' => 'OneTrickPageController',
        ]);
    }
}
