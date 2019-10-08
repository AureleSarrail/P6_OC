<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Video;
use App\Form\AddVideoFormType;
use Doctrine\ORM\EntityManager;
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
    public function index(Trick $trick, AddVideoFormType $addVideo,EntityManagerInterface $em,Request $request)
    {

        $addVideo = $this->createForm(AddVideoFormType::class);

        $addVideo->handleRequest($request);

        if ($addVideo->isSubmitted() && $addVideo->isValid()) {
            $video = $addVideo->getData();

            if (strpos($video->getUrl(),'youtube') or strpos($video->getUrl(),'dailymotion') or strpos($video->getUrl(),'vimeo')) {

                $trick->addVideo($video);

                $em->persist($video);
                $em->flush();

                $this->addFlash('success', 'Vidéo bien ajoutée');

                return $this->redirectToRoute('update_trick', [
                    'id' => $trick->getId()
                ]);
            }
            else
            {
                $this->addFlash('warning', 'La plateforme n\'est pas supportée !' );
            }
        }

        return $this->render('add_videoto_trick/index.html.twig', [
            'addVideo' => $addVideo->createView()
        ]);
    }
}
