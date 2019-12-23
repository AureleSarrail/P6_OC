<?php


namespace App\Service;


use App\Entity\Image;
use App\Entity\Trick;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;

class AddOneImageService
{
    private $em;
    private $uploaderHelper;

    public function __construct(EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {
        $this->em = $em;
        $this->uploaderHelper = $uploaderHelper;
    }

    /**
     * @param $image
     * @param $trick
     */
    public function addOneImage(Image $image,Trick $trick)
    {
        $newFilename = $this->uploaderHelper->uploadImage($image->getFile());

        $image->setUrl($newFilename);
        $trick->addImage($image);

        $this->em->persist($image);
        $this->em->flush();
    }

}