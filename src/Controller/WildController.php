<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\CategoryType;
use App\Form\ProgramSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        $form = $this->createForm(
            CategoryType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
            'form' => $form->createView()
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/wild/show/{slug}", requirements={"slug":"[a-z0-9\-]+"}, defaults={"slug" = ""},  name="wild_show")
     */

    public function show(string $slug): Response
    {
        if (!$slug) {
            throw $this->createNotFoundException(
                'No slug has been sent to find a program in program\'s table .'
            );
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)))
        );

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with ' . $slug . ' title, found in program\'s table.'
            );
        }

        return $this->render('wild/show.html.twig', [
            'website' => 'Wild Series',
            'slug' => $slug,
            'program' => $program
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     *
     * @Route("wild/category/{categoryName}", name="show_category")
     * @return Response
     */

    public function showByCategory(string $categoryName): Response
    {
        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No programs for this category.'
            );
        }

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy([
                'name' => $categoryName
            ]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $category],
                ['id' => 'desc'],
                3
            );

        return $this->render('wild/category.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs,
            'category' => $category,
        ]);
    }

    /**
     * Getting a program with a formatted slug for title
     * @param string $programName is The slugger
     * @Route("wild/program/{programName}", name="show_program")
     * @return Response
     */

    public function showByProgram(string $programName): Response
    {
        if (!$programName) {
            throw $this->createNotFoundException(
                'No programs for this category.'
            );
        }

        $programName = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($programName)))
        );

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(
                ['title' => $programName]
            );

        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(
                ['program' => $program],
                ['number' => 'ASC']
            );

        return $this->render('wild/program.html.twig', [
            'website' => 'Wild Series',
            'slug' => $programName,
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    /**
     *
     * @Route("/wild/season/{id}", name="show_season")
     * @param Season $season
     * @return Response
     */

    public function showBySeason(Season $season): Response
    {
        $program = $season->getProgram();

        $episodes = $season->getEpisodes();

        return $this->render('wild/episodes.html.twig', [
            'website' => 'Wild Series',
            'season' => $season,
            'program' => $program,
            'episodes' => $episodes
        ]);
    }

    /**
     * @Route("/wild/episode/{id}", name="show_episode")
     * @param Episode $episode
     * @param $season
     * @return Response
     */

    public function showEpisode(Episode $episode): Response
    {
        $season = $episode->getSeason();

        $program = $season->getProgram();

        return $this->render('wild/episode.html.twig', [
            'website' => 'Wild Series',
            'episode' => $episode,
            'season' => $season,
            'program' => $program
        ]);
    }
}
