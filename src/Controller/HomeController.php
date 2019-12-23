<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/{page<\d+>}", name="home")
     * @param TrickRepository $repo
     * @param int $page
     * @return Response
     */
    public function index(TrickRepository $repo, int $page = 1, SerializerInterface $serializer)
    {

        $tricks = $repo->findTricksPerPage($page);

        if (count($tricks) == 0) {
            $this->addFlash('danger', "La page n'existe pas");
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
