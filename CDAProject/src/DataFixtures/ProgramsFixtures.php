<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\CategoryRepository;

class ProgramsFixtures extends Fixture
{
    private const PROGRAMS = [
        [
            'title' => 'Initiation à l\'escalade',
            'description' => 'Programme complet de 6 séances pour débuter l\'escalade en toute confiance, incluant l\'apprentissage des techniques de base et de la sécurité.',
            'steps' => [
                'Semaine 1' => [
                    'Séance 1 (Lundi)' => [
                        ['durée' => '30min', 'activité' => 'Présentation du matériel et règles de sécurité'],
                        ['durée' => '45min', 'activité' => 'Apprentissage des nœuds (huit et nœud d\'arrêt)'],
                        ['durée' => '45min', 'activité' => 'Initiation à l\'assurage sur moulinette']
                    ],
                    'Séance 2 (Jeudi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement spécifique escalade'],
                        ['durée' => '1h', 'activité' => 'Techniques de base des pieds et mains'],
                        ['durée' => '30min', 'activité' => 'Pratique sur voies faciles (3a-4b)']
                    ]
                ],
                'Semaine 2' => [
                    'Séance 3 (Lundi)' => [
                        ['durée' => '45min', 'activité' => 'Perfectionnement assurage'],
                        ['durée' => '45min', 'activité' => 'Lecture de voie et placement du corps'],
                        ['durée' => '30min', 'activité' => 'Pratique guidée']
                    ],
                    'Séance 4 (Jeudi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement'],
                        ['durée' => '1h', 'activité' => 'Techniques de progression et équilibre'],
                        ['durée' => '30min', 'activité' => 'Pratique libre supervisée']
                    ]
                ],
                'Semaine 3' => [
                    'Séance 5 (Lundi)' => [
                        ['durée' => '30min', 'activité' => 'Techniques de chute contrôlée'],
                        ['durée' => '1h', 'activité' => 'Introduction au bloc'],
                        ['durée' => '30min', 'activité' => 'Pratique mixte voies/bloc']
                    ],
                    'Séance 6 (Jeudi)' => [
                        ['durée' => '30min', 'activité' => 'Révision générale'],
                        ['durée' => '1h', 'activité' => 'Évaluation technique'],
                        ['durée' => '30min', 'activité' => 'Conseils personnalisés pour la suite']
                    ]
                ]
            ],
            'difficulty' => 'Débutant',
            'duration' => 1.5,
            'price' => 49.99,
            'image' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Perfectionnement technique',
            'description' => 'Programme intensif de 8 séances pour grimpeurs intermédiaires focalisé sur l\'analyse des mouvements techniques et la fluidité des enchaînements.',
            'steps' => [
                // Add steps here if needed
            ],
            'difficulty' => 'Intermédiaire',
            'duration' => 2.0,
            'price' => 69.99,
            'image' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Force et endurance',
            'description' => 'Programme intensif de 10 séances combinant travail de force au campus board et séances d\'endurance pour améliorer vos performances.',
            'steps' => [
                'Semaine 1-5' => [
                    'Mardi (2h) : Séance Force' => [
                        ['durée' => '20min', 'activité' => 'Échauffement progressif'],
                        ['durée' => '30min', 'activité' => 'Exercices au campus board', 'détails' => [
                            '4x5 montées basic ladder',
                            '3x3 doubles dynos',
                            '2x5 lock-offs'
                        ]],
                        ['durée' => '40min', 'activité' => 'Travail au pan Güllich', 'détails' => [
                            'Blocs courts puissants',
                            'Exercices de suspension'
                        ]],
                        ['durée' => '30min', 'activité' => 'Renforcement antagonistes']
                    ],
                    'Vendredi (2h) : Séance Endurance' => [
                        ['durée' => '20min', 'activité' => 'Échauffement cardio et articulaire'],
                        ['durée' => '50min', 'activité' => 'Circuits continus', 'détails' => [
                            '2x20min en 6a',
                            '3x10min en 6b'
                        ]],
                        ['durée' => '30min', 'activité' => 'Travail intermittent', 'détails' => [
                            '8x4min ON / 4min OFF'
                        ]],
                        ['durée' => '20min', 'activité' => 'Étirements et récupération']
                    ]
                ]
            ],
            'difficulty' => 'Avancé',
            'duration' => 2.5,
            'price' => 79.99,
            'image' => 'https://images.unsplash.com/photo-1516592066400-86808b37f0be?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Bloc performance',
            'description' => 'Programme expert de 12 séances focalisé sur la performance en bloc et le développement de la puissance explosive.',
            'steps' => [
                'Semaine 1-3' => [
                    'Séance Bloc (Lundi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement spécifique bloc'],
                        ['durée' => '1h30', 'activité' => 'Travail de puissance', 'détails' => [
                            '8-10 blocs max en 6C/7A',
                            'Focus sur mouvements explosifs'
                        ]],
                        ['durée' => '30min', 'activité' => 'Renforcement spécifique']
                    ],
                    'Séance Technique (Jeudi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement'],
                        ['durée' => '1h30', 'activité' => 'Perfectionnement technique', 'détails' => [
                            'Travail de précision',
                            'Coordination complexe'
                        ]],
                        ['durée' => '30min', 'activité' => 'Étirements']
                    ]
                ]
            ],
            'difficulty' => 'Avancé',
            'duration' => 2.0,
            'price' => 89.99,
            'image' => 'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Mental et visualisation',
            'description' => 'Programme innovant de 6 séances associant pratique de l\'escalade et préparation mentale pour gérer le stress et la confiance en soi.',
            'steps' => [
                'Semaine 1-3' => [
                    'Séance (Mercredi)' => [
                        ['durée' => '30min', 'activité' => 'Méditation et centrage'],
                        ['durée' => '45min', 'activité' => 'Techniques de visualisation'],
                        ['durée' => '45min', 'activité' => 'Application pratique en grimpe']
                    ],
                    'Séance (Samedi)' => [
                        ['durée' => '30min', 'activité' => 'Exercices de respiration'],
                        ['durée' => '1h', 'activité' => 'Gestion du stress en situation'],
                        ['durée' => '30min', 'activité' => 'Débriefing et analyse']
                    ]
                ]
            ],
            'difficulty' => 'Tous niveaux',
            'duration' => 1.0,
            'price' => 59.99,
            'image' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Voies longues',
            'description' => 'Programme spécialisé de 8 séances pour maîtriser les techniques de grande voie et multi-pitch, incluant une sortie en falaise.',
            'steps' => [
                'Semaine 1-4' => [
                    'Séance Indoor (Mardi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement'],
                        ['durée' => '1h', 'activité' => 'Techniques de relais'],
                        ['durée' => '1h30', 'activité' => 'Simulation grande voie']
                    ],
                    'Sortie Falaise (Samedi)' => [
                        ['durée' => '1h', 'activité' => 'Préparation et approche'],
                        ['durée' => '5h', 'activité' => 'Pratique en conditions réelles'],
                        ['durée' => '1h', 'activité' => 'Débriefing']
                    ]
                ]
            ],
            'difficulty' => 'Intermédiaire',
            'duration' => 3.0,
            'price' => 99.99,
            'image' => 'https://images.unsplash.com/photo-1601224335112-b74158e231c9?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Récupération et prévention',
            'description' => 'Programme préventif de 6 séances élaboré avec des kinésithérapeutes pour apprendre les techniques d\'auto-massage et de récupération.',
            'steps' => [
                'Semaine 1-3' => [
                    'Séance (Lundi)' => [
                        ['durée' => '45min', 'activité' => 'Auto-massage et mobilité'],
                        ['durée' => '45min', 'activité' => 'Exercices préventifs'],
                        ['durée' => '30min', 'activité' => 'Étirements spécifiques']
                    ],
                    'Séance (Jeudi)' => [
                        ['durée' => '45min', 'activité' => 'Renforcement des antagonistes'],
                        ['durée' => '45min', 'activité' => 'Techniques de récupération active'],
                        ['durée' => '30min', 'activité' => 'Relaxation guidée']
                    ]
                ]
            ],
            'difficulty' => 'Tous niveaux',
            'duration' => 1.0,
            'price' => 49.99,
            'image' => 'https://images.unsplash.com/photo-1522079803432-e0b7649dc1de?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Compétition lead',
            'description' => 'Programme élite de 15 séances pour compétiteurs incluant planification périodisée et accompagnement en compétition.',
            'steps' => [
                'Phase Préparation (Semaine 1-5)' => [
                    'Séance Technique (Mardi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement spécifique'],
                        ['durée' => '2h', 'activité' => 'Travail technique de difficulté'],
                        ['durée' => '30min', 'activité' => 'Débriefing']
                    ],
                    'Séance Performance (Vendredi)' => [
                        ['durée' => '30min', 'activité' => 'Échauffement'],
                        ['durée' => '2h', 'activité' => 'Simulation compétition'],
                        ['durée' => '30min', 'activité' => 'Analyse vidéo']
                    ]
                ]
            ],
            'difficulty' => 'Expert',
            'duration' => 2.5,
            'price' => 129.99,
            'image' => 'https://images.unsplash.com/photo-1583667355467-00552323c86c?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Dépassement de soi',
            'description' => 'Programme personnalisé de 10 séances avec coach dédié pour atteindre vos objectifs spécifiques en escalade.',
            'steps' => [
                'Programme Personnalisé' => [
                    'Séance 1-5' => [
                        ['durée' => '30min', 'activité' => 'Bilan et objectifs'],
                        ['durée' => '1h30', 'activité' => 'Travail spécifique adapté'],
                        ['durée' => '30min', 'activité' => 'Évaluation progression']
                    ],
                    'Séance 6-10' => [
                        ['durée' => '30min', 'activité' => 'Ajustement objectifs'],
                        ['durée' => '1h30', 'activité' => 'Perfectionnement'],
                        ['durée' => '30min', 'activité' => 'Bilan final']
                    ]
                ]
            ],
            'difficulty' => 'Avancé',
            'duration' => 2.0,
            'price' => 149.99,
            'image' => 'https://images.unsplash.com/photo-1578763363228-6e6bdf1ae300?ixlib=rb-4.0.3',
        ],
        [
            'title' => 'Grimpe en extérieur',
            'description' => 'Programme complet de 8 séances préparant à l\'escalade en milieu naturel avec deux sorties en falaise encadrées.',
            'steps' => [
                'Formation Indoor (Semaine 1-2)' => [
                    'Séance Théorique' => [
                        ['durée' => '1h', 'activité' => 'Sécurité et matériel'],
                        ['durée' => '1h', 'activité' => 'Lecture de topo'],
                        ['durée' => '1h', 'activité' => 'Techniques spécifiques']
                    ]
                ],
                'Sorties Falaise (Semaine 3-4)' => [
                    'Journée Pratique' => [
                        ['durée' => '1h', 'activité' => 'Reconnaissance du site'],
                        ['durée' => '5h', 'activité' => 'Pratique encadrée'],
                        ['durée' => '1h', 'activité' => 'Retour d\'expérience']
                    ]
                ]
            ],
            'difficulty' => 'Intermédiaire',
            'duration' => 2.0,
            'price' => 89.99,
            'image' => 'https://images.unsplash.com/photo-1502126324834-38f8e02d7160?ixlib=rb-4.0.3',
        ],
    ];

    private CategoryRepository $categoryRepository;
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title'])
                   ->setDescription($programData['description'])
                   ->setSteps($programData['steps'])
                   ->setDifficulty($programData['difficulty'])
                   ->setDuration($programData['duration'])
                   ->setPrice($programData['price'])
                   ->setImage($programData['image'])
                   ->setIsCustom(false);

            $category = $this->categoryRepository->find(1); // Assuming category ID 1 is used
            $program->setCategory($category);

            $manager->persist($program);
        }

        $manager->flush();
    }
}
