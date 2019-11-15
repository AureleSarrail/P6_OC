<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\AddVideoFormType;
use App\Service\AddVideoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VideoUpdateController extends AbstractController
{
    /**
     * @Route("/video/update/{id}", name="video_update")
     */
    public function index(Video $video, Request $request, AddVideoManager $manager, EntityManagerInterface $em)
    {
        $addVideoForm = $this->createForm(AddVideoFormType::class);

        $addVideoForm->handleRequest($request);

        if ($addVideoForm->isSubmitted() && $addVideoForm->isValid()) {
            $newVideo = $addVideoForm->getData();

            if (strpos($video->getUrl(), 'youtube') or strpos($video->getUrl(), 'dailymotion') or strpos($video->getUrl(), 'vimeo')) {
                $url = $manager->getSrc($newVideo->getUrl());

                //on remplace l'url par celle obtenue
                $video->setUrl($url);

                //intégration
                $em->persist($video);
                $em->flush();

                //message si ok
                $this->addFlash('success', 'Vidéo bien ajoutée');

                $trick = $video->getTrick();

                //redirection vers la page de mise à jour de la trick
                return $this->redirectToRoute('update_trick', [
                    'slug' => $trick->getSlug()
                ]);
            } else {
                $this->addFlash('warning', 'La plateforme n\'est pas supportée !');
            }
        }

        return $this->render('video_update/index.html.twig', ['addVideo' => $addVideoForm->createView(),
            'video' => $video
        ]);
    }
}
