<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{page<\d+>}", name="home")
     * @param TrickRepository $repo
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TrickRepository $repo,int $page = 1)
    {

        $tricks =  $repo->findTricksPerPage($page);

        if(count($tricks) == 0){
            $this->addFlash('danger', "La page n'existe pas");
            $this->addFlash('danger', "La page n'existe pas 2");
            $this->addFlash('success', "La page n'existe pas 2");
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
