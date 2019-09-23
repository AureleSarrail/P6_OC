<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends AppFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class,50,function(Comment $comment) {

            $faker = \Faker\Factory::create('fr_FR');

            $comment->setUser($this->getRandomReference(User::class))
                ->setContent($faker->sentence())
                ->setCreatedAt($faker->dateTimeThisMonth())
                ->setTrick($this->getRandomReference(Trick::class));

        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixture::class, TrickFixture::class];
    }


}
