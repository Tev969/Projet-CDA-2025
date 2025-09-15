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
    private function getRandomPosition(): string
    {
        $positions = [
            'Debout, pieds écartés à la largeur des épaules',
            'Allongé sur le dos, genoux pliés et pieds à plat',
            'En position de planche, appui sur les avant-bras',
            'Assis sur le sol, jambes tendues',
            'À genoux, mains sur les hanches'
        ];
        return $positions[array_rand($positions)];
    }

    private function getRandomExecution(): string
    {
        $executions = [
            'Levez lentement les bras au-dessus de la tête en gardant les épaules basses',
            'Fléchissez les coudes à 90 degrés en gardant les épaules stables',
            'Soulevez le bassin vers le plafond en contractant les fessiers',
            'Tournez le torse vers la droite puis vers la gauche en contrôlant le mouvement',
            'Tendez une jambe vers l\'arrière en gardant le dos droit',
            'Effectuez une flexion des genoux en gardant le dos droit et les talons au sol'
        ];
        return $executions[array_rand($executions)];
    }
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
                        $duration = rand(5, 20);
                        $exercice->setDuration($duration);
                        $exercice->setDurationInMinutes($duration);
                        $exercice->setSession(sprintf('Session %d', $session));
                        $exercice->setWeek($week);
                        $exercice->setProgram($program);
                        // Set difficulty based on program's difficulty
                        $exercice->setDifficulty($program->getDifficulty());
                        
                        // Set detailed instructions based on exercise details
                        $instructions = sprintf(
                            "Instructions pour l'exercice %d - %s:\n\n" .
                            "1. Échauffement: Faites 5 minutes d'échauffement léger.\n" .
                            "2. Position de départ: %s\n" .
                            "3. Exécution: %s\n" .
                            "4. Durée: Maintenez la position pendant %d secondes.\n" .
                            "5. Répétitions: Faites 3 séries de 10 répétitions.\n" .
                            "6. Respiration: Expirez pendant l'effort, inspirez au retour.\n\n" .
                            "Conseils: Maintenez le dos droit et contrôlez vos mouvements.",
                            $i,
                            $exercice->getName(),
                            $this->getRandomPosition(),
                            $this->getRandomExecution(),
                            $duration
                        );
                        $exercice->setInstructions($instructions);
                        
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
