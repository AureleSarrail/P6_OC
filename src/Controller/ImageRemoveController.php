<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImageRemoveController extends AbstractController
{
    /**
     * @Route("/remove-image/{id}", name="image_remove")
     * @param EntityManagerInterface $manager
     * @param Image $image
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(EntityManagerInterface $manager, Image $image)
    {

        $trick = $image->getTrick();

        $manager->remove($image);
        $manager->flush();

        return $this->redirectToRoute('updateTrick', [
            'id' => $trick->getId()
        ]);
    }
}
