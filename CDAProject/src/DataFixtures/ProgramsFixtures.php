<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\ProgramWeek;
use App\Entity\Exercice;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramsFixtures extends Fixture implements DependentFixtureInterface
{
    private const PROGRAMS = [
        [
            'title' => 'Initiation à l\'escalade',
            'description' => 'Programme complet de 6 séances pour débuter l\'escalade en toute confiance, incluant l\'apprentissage des techniques de base et de la sécurité.',
            'difficulty' => 'Débutant',
            'duration' => 1.5,
            'price' => 49.99,
            'image' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Perfectionnement technique',
            'description' => 'Programme intensif de 8 séances pour grimpeurs intermédiaires focalisé sur l\'analyse des mouvements techniques et la fluidité des enchaînements.',
            'difficulty' => 'Intermédiaire',
            'duration' => 2.0,
            'price' => 69.99,
            'image' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Force et endurance',
            'description' => 'Programme intensif de 10 séances combinant travail de force au campus board et séances d\'endurance pour améliorer vos performances.',
            'difficulty' => 'Avancé',
            'duration' => 2.5,
            'price' => 79.99,
            'image' => 'https://images.unsplash.com/photo-1516592066400-86808b37f0be?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Bloc performance',
            'description' => 'Programme expert de 12 séances focalisé sur la performance en bloc et le développement de la puissance explosive.',
            'difficulty' => 'Avancé',
            'duration' => 2.0,
            'price' => 89.99,
            'image' => 'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Mental et visualisation',
            'description' => 'Programme innovant de 6 séances associant pratique de l\'escalade et préparation mentale pour gérer le stress et la confiance en soi.',
            'difficulty' => 'Tous niveaux',
            'duration' => 1.0,
            'price' => 59.99,
            'image' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Voies longues',
            'description' => 'Programme spécialisé de 8 séances pour maîtriser les techniques de grande voie et multi-pitch, incluant une sortie en falaise.',
            'difficulty' => 'Intermédiaire',
            'duration' => 3.0,
            'price' => 99.99,
            'image' => 'https://images.unsplash.com/photo-1601224335112-b74158e231c9?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Récupération et prévention',
            'description' => 'Programme préventif de 6 séances élaboré avec des kinésithérapeutes pour apprendre les techniques d\'auto-massage et de récupération.',
            'difficulty' => 'Tous niveaux',
            'duration' => 1.0,
            'price' => 49.99,
            'image' => 'https://images.unsplash.com/photo-1522079803432-e0b7649dc1de?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Compétition lead',
            'description' => 'Programme élite de 15 séances pour compétiteurs incluant planification périodisée et accompagnement en compétition.',
            'difficulty' => 'Expert',
            'duration' => 2.5,
            'price' => 129.99,
            'image' => 'https://images.unsplash.com/photo-1583667355467-00552323c86c?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Dépassement de soi',
            'description' => 'Programme personnalisé de 10 séances avec coach dédié pour atteindre vos objectifs spécifiques en escalade.',
            'difficulty' => 'Avancé',
            'duration' => 2.0,
            'price' => 149.99,
            'image' => 'https://images.unsplash.com/photo-1578763363228-6e6bdf1ae300?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Grimpe en extérieur',
            'description' => 'Programme complet de 8 séances préparant à l\'escalade en milieu naturel avec deux sorties en falaise encadrées.',
            'difficulty' => 'Intermédiaire',
            'duration' => 2.0,
            'price' => 89.99,
            'image' => 'https://images.unsplash.com/photo-1502126324834-38f8e02d7160?ixlib=rb-4.0.3',
        ],
    ];

    public function __construct(private CategoryRepository $categoryRepository ,private SluggerInterface $slugger)
    {
       
    }

    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setName('Programme Débutant Complet');
        $program->setDescription('Un programme de 12 semaines pour débutants');
        
        // Création des semaines
        for ($i = 1; $i <= 12; $i++) {
            $week = new ProgramWeek();
            $week->setWeekNumber($i);
            $week->setTitle('Semaine ' . $i);
            $week->setDescription('Objectifs de la semaine ' . $i);
            $week->setProgram($program);
            
            // Ajout d'exercices spécifiques pour chaque semaine
            // ... existing code ...
            
            $manager->persist($week);
        }
        
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ExercicesFixtures::class,
        ];
    }
}
