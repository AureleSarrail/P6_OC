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

        $this->createMany(Image::class,50, function(Image $image) {
            $faker = \Faker\Factory::create('fr_FR');

            $image->setUrl($faker->imageUrl())
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
