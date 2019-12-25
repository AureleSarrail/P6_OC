<?php


namespace App\Service;


use App\Entity\User;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Mailer
{

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param User $user
     * @return int
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendResetPassword(User $user)
    {
        $message = (new Swift_Message('Reset your password'))
            ->setFrom('snowtricks@gmail.com')
            ->setTo($user->getMail())
            ->setBody(
                $this->twig->render('email/reset_password.html.twig', [
                    'user' => $user
                ]),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}

