<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;


class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Catégorie Chaussons
        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Les meilleurs chaussons pour débutants');
        $article->setDescription('Guide complet pour choisir vos premiers chaussons d\'escalade : confort, maintien et durabilité.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1564769662533-4f00a87b4056');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Chaussons agressifs : Pour qui et pourquoi ?');
        $article->setDescription('Tout savoir sur les chaussons agressifs : avantages, inconvénients et quand les utiliser.');
        $article->setState('published');
        $article->setPicture('https://images.unsplash.com/photo-1522079802940-f067af5bf013');
        $article->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Comment resemeler ses chaussons');
        $article->setDescription('Guide pratique pour prolonger la durée de vie de vos chaussons d\'escalade avec un bon ressemelage.');
        $article->setState('published');
        $article->setPicture('https://images.unsplash.com/photo-1551887196-72e32bfc7bf3');
        $article->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Les chaussons pour le bloc');
        $article->setDescription('Sélection des meilleurs chaussons spécialement conçus pour la pratique du bloc.');
        $article->setState('published');    
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1522163182402-834f871fd851');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Entretien de vos chaussons');
        $article->setDescription('Conseils et astuces pour maintenir vos chaussons en parfait état et maximiser leur durée de vie.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1606925797300-0b35e9d1794e');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::CHAUSSONS_REF, Categorie::class));
        $article->setTitle('Chaussons femme vs homme');
        $article->setDescription('Les discrepances entre les chaussons homme et femme : morphologie, design et performances.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        // Catégorie Bons Spots
        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Fontainebleau : Le paradis du bloc');
        $article->setDescription('Découvrez les meilleurs circuits de bloc dans la forêt de Fontainebleau, un spot mythique pour tous les grimpeurs.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1522163182402-834f871fd851');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Les plus belles voies du Verdon');
        $article->setDescription('Guide des meilleures voies dans les gorges du Verdon, de la 5a à la 8a. Découvrez ce site majeur de l\'escalade francaise.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Céüse : Le spot d\'été parfait');
        $article->setDescription('Guide complet de la falaise de Céüse : accès, meilleures périodes et voies incontournables.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1522163182402-834f871fd851');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Les spots secrets des Calanques');
        $article->setDescription('Découverte des sites d\'escalade moins connus mais tout aussi spectaculaires des Calanques de Marseille.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1502126324834-38f8e02d7160');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Escalade hivernale à Kalymnos');
        $article->setDescription('Tout savoir pour organiser son voyage d\'escalade sur l\'île grecque de Kalymnos pendant l\'hiver.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BON_SPOTS_REF, Categorie::class));
        $article->setTitle('Les blocs de Targasonne');
        $article->setDescription('Guide des meilleurs blocs de Targasonne dans les Pyrénées : un spot unique avec vue sur les montagnes.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1522163182402-834f871fd851');
        $manager->persist($article);

        // Catégorie Bonnes Pratiques
        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('Sécurité en falaise : Les fondamentaux');
        $article->setDescription('Les règles essentielles pour grimper en toute sécurité : équipement, techniques d\'assurage et communication avec son partenaire.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('L\'échauffement parfait');
        $article->setDescription('Guide complet pour un échauffement efficace avant l\'escalade : exercices et bonnes pratiques.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('Récupération et prévention des blessures');
        $article->setDescription('Conseils d\'experts pour bien récupérer et éviter les blessures courantes en escalade.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('Éthique et comportement en falaise');
        $article->setDescription('Les bonnes pratiques à adopter en site naturel : respect de l\'environnement et des autres grimpeurs.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('Techniques de respiration en escalade');
        $article->setDescription('Maîtrisez votre respiration pour améliorer votre concentration et vos performances en escalade.');
        $article->setState('published');
 
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $article = new Article();
        $article->addCategory($this->getReference(CategoriesFixtures::BONNES_PRATIQUES_REF, Categorie::class));
        $article->setTitle('Guide de la nutrition pour grimpeurs');
        $article->setDescription('Conseils nutritionnels pour optimiser vos performances et votre récupération en escalade.');
        $article->setState('published');
        $article->setCreatedAt(new \DateTimeImmutable());
        $article->setPicture('https://images.unsplash.com/photo-1516592673884-4a382d1124c2');
        $manager->persist($article);

        $manager->flush();
    }
    public function getDependencies():array
    {
        return [
            CategoriesFixtures::class,
        ];
    }
}
