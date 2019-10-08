<?php

namespace App\Controller;

use App\Entity\Video;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoRemoveController extends AbstractController
{
    /**
     * @Route("/video_remove/{id}", name="video_remove")
     */
    public function index(Video $video,EntityManagerInterface $em)
    {
        $trick = $video->getTrick();

        $em->remove($video);
        $em->flush();

        return $this->redirectToRoute('update_trick', [
            'id' => $trick->getId()
        ]);
    }
}
