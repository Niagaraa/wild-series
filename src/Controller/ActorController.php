<?php


namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor/{id}", name="actor_show")
     */

    public function showActor(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
            'programs' => $actor->getPrograms()
        ]);
    }

}