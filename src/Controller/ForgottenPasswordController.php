<?php

namespace App\Controller;

use App\Form\ForgottenPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ForgottenPasswordController extends AbstractController
{
    /**
     * @Route("/forgotten/password", name="forgotten_password")
     * @param Request $request
     * @param UserRepository $userRepository
     * @param TokenGeneratorInterface $tokenGenerator
     * @param \Swift_Mailer $mailer
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request,
                          UserRepository $userRepository,
                          TokenGeneratorInterface $tokenGenerator,
                          \Swift_Mailer $mailer,
                          EntityManagerInterface $em)
    {

        $userForm = $this->createForm(ForgottenPasswordType::class);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $mail = $userForm->getData()['mail'];
            /** @var $user $user */
            $user = $userRepository->findUserByMail($mail);
//            dd($user);

            if ($user === null) {
                $this->addFlash('danger', 'Cette adresse mail n\'existe pas !');
                $this->redirectToRoute('forgotten_password');
            } else {
                $token = $tokenGenerator->generateToken();
//                dd($token);
                $user->setResetToken($token);
                $em->persist($user);
                $em->flush();

                $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
                $message = (new \Swift_Message('Reset your password'))
                    ->setFrom('snowtricks@gmail.com')
                    ->setTo($user->getMail())
                    ->setBody(
                        "If you want to reset your password click here : " . $url,
                        'text/html'
                    );

                $mailer->send($message);

                $this->addFlash('success', 'Le mail a bien été envoyé.');
                return $this->redirectToRoute('home');

            }
        }

        return $this->render('forgotten_password/index.html.twig', [
            'form' => $userForm->createView()
        ]);

    }
}
