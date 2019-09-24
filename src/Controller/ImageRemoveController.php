<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ImageRemoveController extends AbstractController
{
    /**
     * @Route("/removeImage/{trickId}/{picId}", name="image_remove")
     */
    public function index(ImageRepository $imageRepository,TrickRepository $trickRepository ,$trickId,$picId)
    {
        $image = $imageRepository->getImagebyId($picId);

        $trick = $trickRepository->oneTrickById($trickId);

        $trick->removeImage($image);

        return $this->redirectToRoute('updateTrick', [
            'id' => $trickId
        ]);
    }
}
