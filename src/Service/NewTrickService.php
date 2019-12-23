<?php


namespace App\Service;


use App\Entity\Trick;
use App\Security\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;

class NewTrickService
{
    private $em;
    private $uploaderHelper;

    public function __construct(EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {
        $this->em = $em;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function newTrick(Trick $trick)
    {
        if ($trick->getName() == null) {
            throw new \InvalidArgumentException('Pas de nom de trick');
        }

        if ($trick->getSlug() == null) {
            throw new \InvalidArgumentException('Pas de catégorie choisie');
        }

        if ($trick->getDescription() == null) {
            throw new \InvalidArgumentException('pas de description entrée');
        }

        foreach ($trick->getImages() as $image) {
            $newFilename = $this->uploaderHelper->uploadImage($image->getFile());
            $image->setUrl($newFilename);
        }

        $this->em->persist($trick);
        $this->em->flush();

        return $trick;
    }

}