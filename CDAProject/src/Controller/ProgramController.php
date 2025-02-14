<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Enum\WeekEnum;

class ProgramController extends AbstractController
{
    #[Route('/programs', name: 'app_programs')]
    public function index(ProgramRepository $programRepository): Response
    {
        return $this->render('program/index.html.twig', [
            'programs' => $programRepository->findAll(),
        ]);
    }

    #[Route('/program/{id}', name: 'app_program_show')]
    public function show(Program $program): Response
    {
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'exercices' => $program->getExercices(),
            'weeks' => WeekEnum::cases(),
        ]);
    }
} 