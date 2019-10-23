<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\AddVideoFormType;
use App\Service\AddVideoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddVideotoTrickController extends AbstractController
{
    /**
     * @Route("/addVideo/{id}", name="add_video_to_trick")
     * @param Trick $trick
     * @param AddVideoFormType $addVideo
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Trick $trick, AddVideoFormType $addVideo, EntityManagerInterface $em, AddVideoManager $manager, Request $request)
    {

        $addVideo = $this->createForm(AddVideoFormType::class);

        $addVideo->handleRequest($request);

        if ($addVideo->isSubmitted() && $addVideo->isValid()) {
            $video = $addVideo->getData();

            //on fait un test si la plateforme est supportée
            if (strpos($video->getUrl(), 'youtube') or strpos($video->getUrl(), 'dailymotion') or strpos($video->getUrl(), 'vimeo')) {

                $url = $manager->getSrc($video->getUrl());

                //on remplace l'url par celle obtenue
                $video->setUrl($url);

                //on l'ajoute à la trick
                $trick->addVideo($video);

                //intégration
                $em->persist($video);
                $em->flush();

                //message si ok
                $this->addFlash('success', 'Vidéo bien ajoutée');

                //redirection vers la page de mise à jour de la trick
                return $this->redirectToRoute('update_trick', [
                    'id' => $trick->getId()
                ]);
            } else {
                $this->addFlash('warning', 'La plateforme n\'est pas supportée !');
            }
        }

        return $this->render('add_videoto_trick/index.html.twig', [
            'addVideo' => $addVideo->createView()
        ]);
    }
}
