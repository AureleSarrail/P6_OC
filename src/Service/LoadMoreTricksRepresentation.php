<?php


namespace App\Service;


use App\Entity\Trick;
use Symfony\Component\Asset\Packages;

class LoadMoreTricksRepresentation
{

    /**
     * @var Packages
     */
    private $package;

    public function __construct(Packages $package)
    {

        $this->package = $package;
    }

    /**
     * @param Trick[] $tricks
     * @return array
     */
    public function __invoke($tricks)
    {

        $represent = [];

        foreach ($tricks as $trick) {
            if ($trick->getImages()->count() != 0) {
                $represent[] = array(
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                    'slug' => $trick->getSlug(),
                    'image' => $this->package->getUrl('uploads/' . $trick->getImages()->first()->getUrl())
                );

            } else {
                $images = [];
                $image = $this->package->getUrl('images/HomePic.jpg');
                $images[] = $image;
                $represent[] = array(
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                    'slug' => $trick->getSlug(),
                    'image' => $images);
            }
        }

        return $represent;

    }
}