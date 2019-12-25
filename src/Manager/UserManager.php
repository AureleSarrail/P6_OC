<?php


namespace App\Manager;

use App\Entity\User;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UserManager
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $entityManager,
        Mailer $mailer
    ) {
        $this->tokenGenerator = $tokenGenerator;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    public function generateResetToken(User $user)
    {
        $token = $this->tokenGenerator->generateToken();

        $user->setResetToken($token);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->mailer->sendResetPassword($user);
    }
}
