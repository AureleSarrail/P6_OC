<?php

namespace App\Tests;

use App\Entity\User;
use App\Service\CreateNewUser;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateNewUserTest extends TestCase
{

    /**
     * @var CreateNewUser
     */
    private $createNewUser;

    protected function setUp()
    {

        $em = $this->createMock(EntityManagerInterface::class);
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $encoder->method('encodePassword')
            ->willReturn('hash');

        $this->createNewUser = new CreateNewUser($em, $encoder);
    }


    public function userProviderOk()
    {
        $user = new User();
        $user->setUsername('toto')
            ->setMail('toto@toto.fr')
            ->setPassword('toto');
        return [
            [$user]
        ];
    }


    public function userProviderNotOk()
    {
        $user = new User();
        $user->setUsername('')
            ->setMail('toto@toto.fr')
            ->setPassword('toto');
        return [
            [$user]
        ];
    }


    /**
     * @dataProvider userProviderOk
     */
    public function testCreateNewUserOK(User $user)
    {
        $test = $this->createNewUser->newUser($user);

        $this->assertInstanceOf(User::class, $test);
        $this->assertEquals($test->getUsername(), $user->getUsername());
    }


    /**
     * @dataProvider userProviderNotOk
     */
    public function testCreateNewUserNotOK(User $user)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->createNewUser->newUser($user);

    }
}
