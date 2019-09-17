<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        //On crée 3 catégories
        for ($i=0; $i < 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($category);

            //on créé 5 tricks par catégories
            for ($j=0; $j<5; $j++) {
                $trick = new Trick();
                $trick->setTrickname($faker->sentence())
                    ->setDescription($faker->paragraph())
                    ->setCreatedAt($faker->dateTimeBetween('-3 months'))
                    ->setUpdatedAt(new \DateTime())
                    ->setCategory($category);

                $manager->persist($trick);

                //on créée 5 images et 2 vidéos par tricks
                for ($k=0; $k < 5; $k++) {
                    $image = new Image();
                    $image->setUrl($faker->imageUrl())
                        ->setTrick($trick);

                    $manager->persist($image);
                }
                for ($l=0; $l<2; $l++) {
                    $video = new Video();
                    $video->setUrl('https://www.youtube.com/embed/1TJ08caetkw?rel=0')
                        ->setTrick($trick);
                    $manager->persist($video);
                }
            }
        }

        $manager->flush();
    }
}
