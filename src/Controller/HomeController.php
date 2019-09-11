<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TrickRepository $repo, $page = 0)
    {
//        $tricks = $repo->findTricksPerPage($page);
//
//        $tricks = $repo->findBy(
//            array(),
//            array('id' => 'asc'),
//            15,
//            0
//        );


        return $this->render('home/index.html.twig', [
            'Tricks' => $repo->findTricksPerPage($page)
        ]);
    }
}
