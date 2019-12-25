<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Trick;
use App\Security\UploaderHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageFixture extends AppFixtures implements DependentFixtureInterface
{
    private $uploadHelper;

    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploadHelper = $uploaderHelper;
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Image::class, 250, function (Image $image) {
            $faker = \Faker\Factory::create('fr_FR');

            $url = array(
                'snow1.jpg',
                'snow2.jpg',
                'snow3.jpg',
                'snow4.jpg',
                'snow5.jpg',
                'snow6.jpg'
            );

            $file = $url[rand(0, 5)];

            $fs = new Filesystem();
            $targetpath = sys_get_temp_dir() . '\\' . $file;
            $fs->copy('C:\wamp64\www\P6_OC\public\uploads\\' . $file, $targetpath, true);


            $newFilename = $this->uploadHelper->uploadImage(new File($targetpath));

            $image->setUrl($newFilename)
                ->setTrick($this->getRandomReference(Trick::class));
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [TrickFixture::class];
    }
}
