<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\AddVideoFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddVideotoTrickController extends AbstractController
{
    /**
     * @Route("/addVideo/{id}", name="add_video_to_trick")
     */
    public function index(Trick $trick, AddVideoFormType $addVideo)
    {

        $addVideo = $this->createForm(AddVideoFormType::class);

        return $this->render('add_videoto_trick/index.html.twig', [
            'addVideo' => $addVideo->createView()
        ]);
    }
}
