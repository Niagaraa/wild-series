<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/mon-compte", name="user_profile")
     * @IsGranted("ROLE_SUBSCRIBER")
     */

    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig', [
            'user' => $this->getUser()
        ]);
    }

}