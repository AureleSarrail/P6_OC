<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class,5,function(User $user){

            $faker = \Faker\Factory::create('fr_FR');
            $password = 'root';

            $user->setFirstName($faker->firstname())
                ->setLastName($faker->lastName)
                ->setPassword($password)
                ->setAvatar($faker->imageUrl());

        });

        $manager->flush();
    }
}
