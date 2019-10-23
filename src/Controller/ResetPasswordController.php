<?php

namespace App\Controller;

use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/reset_password/{token}", name="reset_password")
     */
    public function index($token, UserRepository $userRepository,
                          Request $request,
                          UserPasswordEncoderInterface $encoder,
                          EntityManagerInterface $em)
    {

        $user = $userRepository->findUserByResetToken($token);

        if ($user === null) {
            $this->addFlash('danger', 'Token invalide');
            return $this->redirectToRoute('home');
        }

        $resetPassForm = $this->createForm(ResetPasswordType::class);

        $resetPassForm->handleRequest($request);

        if ($resetPassForm->isSubmitted() && $resetPassForm->isValid()) {
            $value = $resetPassForm->getData();

                $user->setPassword($encoder->encodePassword($user, $value['password']['first']))
                    ->setResetToken(null);
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre mot de passe a bien été réinitialisé !');
                return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/index.html.twig', [
            'form' => $resetPassForm->createView()
        ]);
    }
}
