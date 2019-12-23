<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGetUsername()
    {
        $user = new User();
        $user->setUsername('toto');

        $test = $user->getUsername();

        $this->assertEquals('toto', $test);
    }

    public function testUserSetUsername()
    {
        $user = new User();
        $test = $user->setUsername('toto');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetRoles()
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $test = $user->getRoles();

        $this->assertEquals(['ROLE_USER'],$test);
    }

    public function testUserSetRoles()
    {
        $user = new User();
        $test = $user->setRoles(['ROLE_USER']);

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetPassword()
    {
        $user = new User();
        $user->setPassword('toto');

        $test = $user->getPassword();

        $this->assertEquals('toto',$test);
    }

    public function testUserSetPassword()
    {
        $user = new User();
        $test = $user->setPassword('toto');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetMail()
    {
        $user = new User();
        $user->setMail('toto');

        $test = $user->getMail();

        $this->assertEquals('toto', $test);
    }

    public function testUserSetMail()
    {
        $user = new User();
        $test = $user->setMail('toto');

        $this->assertInstanceOf(User::class, $test);
    }

    public function testUserGetResetToken()
    {
        $user = new User();
        $user->setResetToken('toto');

        $test = $user->getResetToken();

        $this->assertEquals('toto', $test);
    }
}
