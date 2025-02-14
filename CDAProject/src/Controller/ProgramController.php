<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Enum\WeekEnum;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/programs', name: 'app_programs')]
    public function index(ProgramRepository $programRepository): Response
    {
        return $this->render('program/index.html.twig', [
            'programs' => $programRepository->findAll(),
        ]);
    }

    #[Route('/program/save/{id}', name: 'app_program_save')]
    public function save(Program $program , EntityManagerInterface $entityManager): Response
    {
        $program->addUser($this->getUser());
        $entityManager->flush();
        $this->addFlash('success', 'Programme sauvegardé avec succès');
        return $this->redirectToRoute('app_program_show', ['id' => $program->getId()]);
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

    #[Route('/my-programs', name: 'app_my_programs')]
    public function myPrograms(ProgramRepository $programRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour accéder à vos programmes');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('program/my_programs.html.twig', [
            'programs' => $user->getPrograms(),
        ]);
    }
} 