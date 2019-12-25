<?php


namespace App\Service;

use App\Entity\Image;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;

class UpdateImageService
{
    private $em;
    private $uploaderHelper;

    public function __construct(UploaderHelper $uploaderHelper, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function updateImage($uploadedFile, Image $image)
    {
        $newFilename = $this->uploaderHelper->uploadImage($uploadedFile, $image->getUrl());

        $image->setUrl($newFilename);

        $this->em->persist($image);
        $this->em->flush();
    }
}