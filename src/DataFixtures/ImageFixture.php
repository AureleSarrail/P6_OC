<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ImageFixture extends AppFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Image::class,250, function(Image $image) {
            $faker = \Faker\Factory::create('fr_FR');

            $url = array(
                'snow1.gif',
                'snow2.jpg',
                'snow3.jpg',
                'snow4.jpg',
                'snow6.jpg'
            );


            $image->setUrl($url[rand(0,4)])
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
