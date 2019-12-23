<?php


namespace App\Service;


use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class AddOneVideoService
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addOneVideo(Video $video, Trick $trick)
    {
        //on l'ajoute à la trick
        $trick->addVideo($video);

        //intégration
        $this->em->persist($video);
        $this->em->flush();
    }

}