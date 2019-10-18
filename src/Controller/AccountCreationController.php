<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountCreationController extends AbstractController
{
    /**
     * @Route("/account/creation", name="account_creation")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $userForm = $this->createForm(UserType::class);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $newUser = $userForm->getData();

            if ($newUser['password'] == $newUser['controlPass']) {
                $user = new User();
                $user->setUsername($newUser['username'])
                    ->setMail($newUser['mail'])
                    ->setPassword($encoder->encodePassword($user, $newUser['password']));

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre compte a été créé avec succés');

                return $this->redirectToRoute('app_login');

            } else {
                $this->addFlash('warning', 'Les mots de passes de sont pas identiques !');
            }
        }

        return $this->render('account_creation/index.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}
