<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index(): Response
    {
        return $this->render('wild/home.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }

    /**
     * @Route("/wild/show/{slug}", requirements={"slug":"[a-z0-9\-]+"}, defaults={"slug" = ""},  name="wild_show")
     */

    public function show(string $slug): Response
    {
        $slug = str_replace("-", " ", $slug);
        $slug = ucwords($slug);

        return $this->render('wild/show.html.twig', [
            'website' => 'Wild Séries',
            'slug' => $slug
        ]);
    }
}
