<?php

namespace App\Controller;

use App\Entity\Video;
use App\Service\DeleteVideoService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class VideoRemoveController extends AbstractController
{
    /**
     * @Route("/video_remove/{id}", name="video_remove")
     * @Security("has_role('ROLE_USER')")
     * @param Video $video
     * @param DeleteVideoService $service
     * @return RedirectResponse
     */
    public function index(Video $video, DeleteVideoService $service)
    {
        $trick = $service->deleteVideo($video);

        $this->addFlash('success', 'La vidéo a bien été supprimée.');

        return $this->redirectToRoute('update_trick', [
            'slug' => $trick->getSlug()
        ]);
    }
}
