<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateNewUser
{

    private $em;
    private $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function newUser(string $username, string $mail, string  $password)
    {

        if(strlen($username) < 3){
            throw new \InvalidArgumentException("Le username doit faire plus de 3 caractères");
        }

        $user = new User();
        $user->setUsername($username)
            ->setMail($mail)
            ->setPassword($this->encoder->encodePassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

}