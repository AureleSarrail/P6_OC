<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;


class CategoryFixture extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {


        $this->createMany(Category::class, 3, function (Category $category, $count) {
            $faker = \Faker\Factory::create('fr_FR');

            $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());
        });

        $manager->flush();
    }
}
