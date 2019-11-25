<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class WildController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     *
     * @Route("/wild", name="wild_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if (!$programs) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
            'programs' => $programs
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
