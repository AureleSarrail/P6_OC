<?php

namespace App\Controller;

use App\Form\ForgottenPasswordType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgottenPasswordController extends AbstractController
{
    /**
     * @Route("/forgotten_password", name="forgotten_password")
     * @param Request $request
     * @param UserManager $userManager
     * @param UserRepository $userRepository
     * @return RedirectResponse|Response
     */
    public function index(
        Request $request,
        UserManager $userManager,
        UserRepository $userRepository
    )
    {

        $userForm = $this->createForm(ForgottenPasswordType::class);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            try {
                $user = $userRepository->findUserByMail($userForm->getData()['mail']);
                $userManager->generateResetToken($user);

                $this->addFlash('success', 'Le mail a bien été envoyé.');

            } catch (NonUniqueResultException $e) {
                $this->addFlash('danger', 'Cette adresse mail n\'existe pas !');
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('forgotten_password/index.html.twig', [
            'form' => $userForm->createView()
        ]);
    }
}
