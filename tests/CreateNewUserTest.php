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
        return [
            ['toto', 'toto@toto.fr', 'toto']
        ];
    }


    public function userProviderNotOk()
    {
        return [
            ['', 'toto@toto.fr', 'toto']
        ];
    }


    /**
     * @dataProvider userProviderOk
     */
    public function testCreateNewUserOK($username, $mail, $password)
    {
        $user = $this->createNewUser->newUser($username, $mail, $password);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->getUsername(), $username);
    }


    /**
     * @dataProvider userProviderNotOk
     */
    public function testCreateNewUserNotOK($username, $mail, $password)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->createNewUser->newUser($username, $mail, $password);

    }
}
