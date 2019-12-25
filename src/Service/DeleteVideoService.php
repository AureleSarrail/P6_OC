<?php


namespace App\Service;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class DeleteVideoService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function deleteVideo(Video $video)
    {
        $trick = $video->getTrick();

        $this->em->remove($video);
        $this->em->flush();

        return $trick;
    }
}
