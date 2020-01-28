<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Profile extends AbstractController
{
    /**
     * @Route("/my-profile", name="user_profile")
     */

    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig');
    }

}