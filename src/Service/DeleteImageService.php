<?php


namespace App\Service;


use App\Entity\Image;
use App\Entity\Trick;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;

class DeleteImageService
{

    private $em;
    private $uploadHelper;

    public function __construct(EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {
        $this->em = $em;
        $this->uploadHelper = $uploaderHelper;
    }

    public function deleteImage(Image $image): Trick
    {
        $trick = $image->getTrick();
        $trick->removeImage($image);

        $this->uploadHelper->deleteImage($image->getUrl());

        $this->em->remove($image);
        $this->em->flush();


        return $trick;
    }

}