<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixture extends AppFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Trick::class, 100, function (Trick $trick) {

            $faker = \Faker\Factory::create('fr_FR');

            $trick->setName($faker->sentence())
                ->setDescription($faker->paragraph())
                ->setCreatedAt($faker->dateTimeBetween('-3 months'))
                ->setUpdatedAt(new \DateTime());

            $trick->setCategory($this->getRandomReference(Category::class));
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
        return [CategoryFixture::class];
    }
}
