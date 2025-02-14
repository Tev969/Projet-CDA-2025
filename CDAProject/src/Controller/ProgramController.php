<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Entity\Enum\WeekEnum;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
        $this->addFlash('success', 'Program saved successfully');
        return $this->redirectToRoute('app_program_show', ['id' => $program->getId()]);
    }

    #[Route('/program/unsave/{id}', name: 'app_program_unsave')]
    public function unsave(Program $program, EntityManagerInterface $entityManager ): Response
    {
        $program->removeUser($this->getUser());
        $entityManager->flush();
        $this->addFlash('success', 'Programme retiré de vos favoris');
        return $this->redirectToRoute('app_profil');
    }

    #[Route('/program/create', name: 'app_program_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, #[Autowire('%photo_dir%')] string $photoDir): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $program->setUser($this->getUser());
            if ($photo = $form['photo']->getData()) {
                $filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();
                try {
                    $photo->move($photoDir, $filename);
                } catch (FileException $e) {
                }
                $program->setImage($filename);

            }
            $entityManager->persist($program);
            
            $entityManager->flush();
            return $this->redirectToRoute('app_program_show', ['id' => $program->getId()]);
        }

        return $this->render('program/create.html.twig', [
            'form' => $form->createView(),
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