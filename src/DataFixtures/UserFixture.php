<?php
namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixture extends AppFixtures
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class,5,function(User $user){
            $faker = \Faker\Factory::create('fr_FR');
            $password = 'root';
            $user->setUsername($faker->firstname());
            $user->setPassword($this->encoder->encodePassword($user,'root'));
        });
        $manager->flush();
    }
}