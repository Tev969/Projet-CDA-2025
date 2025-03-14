<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Enum\WeekEnum;
use App\Entity\Program;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ExercicesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer tous les programmes
        $programs = $manager->getRepository(Program::class)->findAll();

        // Pour chaque programme
        foreach ($programs as $program) {
            // Création des exercices pour chaque semaine
            foreach (WeekEnum::cases() as $week) {
                // Pour chaque semaine, créer 3 sessions
                for ($session = 1; $session <= 3; $session++) {
                    // Pour chaque session, créer 4 exercices
                    for ($i = 1; $i <= 4; $i++) {
                        $exercice = new Exercice();
                        $exercice->setName(sprintf('Exercice %d - Session %d - %s - %s', 
                            $i, 
                            $session, 
                            $week->value,
                            $program->getTitle()
                        ));
                        $exercice->setDescription(sprintf(
                            'Description détaillée de l\'exercice %d de la session %d - %s du programme %s', 
                            $i, 
                            $session, 
                            $week->value,
                            $program->getTitle()
                        ));
                        $exercice->setDuration(rand(5, 20));
                        $exercice->setSession(sprintf('Session %d', $session));
                        $exercice->setWeek($week);
                        $exercice->setProgram($program);
                        
                        $manager->persist($exercice);
                    }
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramsFixtures::class,
        ];
    }
}
