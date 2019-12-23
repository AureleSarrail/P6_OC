<?php

namespace App\Controller;

use App\Entity\Image;
use App\Service\DeleteImageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class ImageRemoveController extends AbstractController
{
    /**
     * @Route("/remove_image/{id}", name="image_remove")
     * @Security("has_role('ROLE_USER')")
     * @param Image $image
     * @param DeleteImageService $service
     * @return RedirectResponse
     */
    public function index(Image $image, DeleteImageService $service)
    {

        $trick = $service->deleteImage($image);

        $this->addFlash('success', 'L\'image a bien été supprimée.');

        return $this->redirectToRoute('update_trick', [
            'slug' => $trick->getSlug()
        ]);
    }
}
