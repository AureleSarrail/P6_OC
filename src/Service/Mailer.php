<?php


namespace App\Service;


use App\Entity\User;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class Mailer
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendResetPassword(User $user)
    {

        $message = (new \Swift_Message('Reset your password'))
            ->setFrom('snowtricks@gmail.com')
            ->setTo($user->getMail())
            ->setBody(
                $this->twig->render('email/reset_password.html.twig',[
                    'user' => $user
                ]),
                'text/html'
            );

        return $this->mailer->send($message);

    }
}