<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTrickController extends AbstractController
{
    /**
     * @Route("/updateTrick/{slug}", name="update_trick", options={"expose" = true})
     * @Security("has_role('ROLE_USER')")
     * @param Trick $trick
     * @return Response
     */
    public function index(Trick $trick)
    {

        $trickForm = $this->createForm(TrickType::class);

        return $this->render('update_trick/index.html.twig', [
            'trick' => $trick,
            'trickForm' => $trickForm->createView()
        ]);
    }
}
