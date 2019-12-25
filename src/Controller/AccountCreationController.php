<?php

namespace App\Controller;

use App\Form\RegisterType;
use App\Service\CreateNewUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountCreationController extends AbstractController
{
    /**
     * @Route("/account_creation", name="account_creation")
     * @param Request $request
     * @param CreateNewUser $createNewUser
     * @return Response
     */
    public function index(Request $request, CreateNewUser $createNewUser)
    {
        $userForm = $this->createForm(RegisterType::class);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $data = $userForm->getData();
            //Création de l'Utilisateur
            $user = $createNewUser->newUser($data);

            if ($user) {
                $this->addFlash('success', 'Votre compte a été créé avec succés');
            } else {
                $this->addFlash('warning', 'Problème lors de la création du compte');
            }

            return $this->redirectToRoute('app_login');
        }

        return $this->render('account_creation/index.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}
