<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Enum\StateEnum;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    private const ARTICLES_DATA = [
        [
            'title' => 'Les meilleurs chaussons pour débutants',
            'description' => 'Guide complet pour choisir vos premiers chaussons d\'escalade : confort, maintien et durabilité.',
            'picture' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Chaussons agressifs : Pour qui et pourquoi ?',
            'description' => 'Tout savoir sur les chaussons agressifs : avantages, inconvénients et quand les utiliser.',
            'picture' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Comment resemeler ses chaussons',
            'description' => 'Guide pratique pour prolonger la durée de vie de vos chaussons d\'escalade avec un bon ressemelage.',
            'picture' => 'https://images.unsplash.com/photo-1551887196-72e32bfc7bf3',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Les chaussons pour le bloc',
            'description' => 'Sélection des meilleurs chaussons spécialement conçus pour la pratique du bloc.',
            'picture' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Entretien de vos chaussons',
            'description' => 'Conseils et astuces pour maintenir vos chaussons en parfait état et maximiser leur durée de vie.',
            'picture' => 'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Chaussons femme vs homme',
            'description' => 'Les discrepances entre les chaussons homme et femme : morphologie, design et performances.',
            'picture' => 'https://images.unsplash.com/photo-1516592673884-4a382d1124c2',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Fontainebleau : Le paradis du bloc',
            'description' => 'Découvrez les meilleurs circuits de bloc dans la forêt de Fontainebleau, un spot mythique pour tous les grimpeurs.',
            'picture' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        [
            'title' => 'Les plus belles voies du Verdon',
            'description' => 'Guide des meilleures voies dans les gorges du Verdon, de la 5a à la 8a. Découvrez ce site majeur de l\'escalade francaise.',
            'picture' => 'https://images.unsplash.com/photo-1516592673884-4a382d1124c2',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        // Nouveaux articles pour "Les bonnes pratiques"
        [
            'title' => 'Échauffement efficace en escalade',
            'description' => 'Guide complet des exercices d\'échauffement essentiels avant une session d\'escalade pour prévenir les blessures.',
            'picture' => 'https://images.unsplash.com/photo-1516592673884-4a382d1124c2',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        [
            'title' => 'La sécurité en premier',
            'description' => 'Les règles d\'or de la sécurité en escalade : vérification du matériel, communication avec le partenaire et bonnes pratiques.',
            'picture' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        [
            'title' => 'Technique de respiration en escalade',
            'description' => 'Maîtrisez votre respiration pour améliorer votre performance et votre concentration pendant l\'escalade.',
            'picture' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        [
            'title' => 'Récupération et nutrition',
            'description' => 'Conseils nutritionnels et techniques de récupération pour optimiser vos performances en escalade.',
            'picture' => 'https://images.unsplash.com/photo-1551887196-72e32bfc7bf3',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        [
            'title' => 'Progression mentale en escalade',
            'description' => 'Développez votre mental et surmontez vos peurs pour progresser en escalade.',
            'picture' => 'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        [
            'title' => 'Lecture de voies efficace',
            'description' => 'Apprenez à lire les voies et à planifier vos mouvements pour grimper plus efficacement.',
            'picture' => 'https://images.unsplash.com/photo-1516592673884-4a382d1124c2',
            'category' => CategoriesFixtures::BONNES_PRATIQUES_REF
        ],
        // Nouveaux articles pour "Les bon spots"
        [
            'title' => 'Les falaises de Céüse',
            'description' => 'Découvrez ce site majeur de l\'escalade sportive dans les Hautes-Alpes, réputé mondialement.',
            'picture' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        [
            'title' => 'Kalymnos : Le paradis grec',
            'description' => 'Guide complet pour grimper sur l\'île de Kalymnos : secteurs, périodes idéales et logistique.',
            'picture' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        [
            'title' => 'Les spots de Finale Ligure',
            'description' => 'Les meilleures falaises de la riviera italienne : un mix parfait entre escalade et dolce vita.',
            'picture' => 'https://images.unsplash.com/photo-1551887196-72e32bfc7bf3',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        [
            'title' => 'Siurana : Le joyau espagnol',
            'description' => 'Guide des secteurs et des voies incontournables de Siurana, en Catalogne.',
            'picture' => 'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e',
            'category' => CategoriesFixtures::BON_SPOTS_REF
        ],
        // Nouveaux articles pour "Les chaussons"
        [
            'title' => 'Les chaussons pour la dalle',
            'description' => 'Sélection des meilleurs chaussons pour l\'escalade en dalle : adhérence et sensibilité.',
            'picture' => 'https://images.unsplash.com/photo-1516592673884-4a382d1124c2',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Comment choisir sa pointure',
            'description' => 'Guide détaillé pour bien choisir la taille de vos chaussons selon votre niveau et style d\'escalade.',
            'picture' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Les différentes gommes de chaussons',
            'description' => 'Comparatif des différentes gommes utilisées pour les chaussons : avantages et inconvénients.',
            'picture' => 'https://images.unsplash.com/photo-1564769662533-4f00a87b4056',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ],
        [
            'title' => 'Chaussons synthétiques vs cuir',
            'description' => 'Analyse comparative entre les chaussons en matériaux synthétiques et en cuir.',
            'picture' => 'https://images.unsplash.com/photo-1551887196-72e32bfc7bf3',
            'category' => CategoriesFixtures::CHAUSSONS_REF
        ]
    ];

    public function __construct(private SluggerInterface $slugger) {
    }

    private function createArticle(
        ObjectManager $manager,
        string $categoryRef,
        string $title,
        string $description,
        string $picture
    ): void {
        $article = new Article();
        $article->addCategory($this->getReference($categoryRef, Category::class))
                ->setTitle($title)
                ->setDescription($description)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setPicture($picture)
                ->setState(StateEnum::PUBLISHED)
                ->setSlug($this->slugger->slug($title));

        
        $manager->persist($article);
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::ARTICLES_DATA as $articleData) {
            $this->createArticle(
                $manager,
                $articleData['category'],
                $articleData['title'],
                $articleData['description'],
                $articleData['picture']
            );
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoriesFixtures::class,
        ];
    }
}
