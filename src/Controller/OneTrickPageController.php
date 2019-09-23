<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OneTrickPageController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="show")
     */
    public function index($id, TrickRepository $repo)
    {
        return $this->render('one_trick_page/index.html.twig', [
            'trick' => $repo->oneTrickById($id)
        ]);
    }
}
