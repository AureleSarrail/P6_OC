<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\AddImageFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddImagetoTrickController extends AbstractController
{
    /**
     * @Route("/addimage/{id}", name="add_image_to_trick")
     */
    public function index(Trick $trick, AddImageFormType $addImage)
    {

        $addImage = $this->createForm(AddImageFormType::class);

        return $this->render('add_imageto_trick/index.html.twig', [
            'addImage' => $addImage->createView()
        ]);
    }
}
