<?php


namespace App\Service;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class UpdateVideoService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function updateVideo(Video $newVideo, Video $video)
    {
        $video->setUrl($newVideo->getUrl());

        $this->em->persist($video);
        $this->em->flush();

        $trick = $video->getTrick();

        return $trick;
    }
}
