<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;


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
