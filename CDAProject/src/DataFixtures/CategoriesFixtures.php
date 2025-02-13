<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoriesFixtures extends Fixture
{
    public const CHAUSSONS_REF = 'chaussons';
    public const BON_SPOTS_REF = 'bon-spots';
    public const BONNES_PRATIQUES_REF = 'bonnes-pratiques';

    private const CATEGORIES = [
        self::CHAUSSONS_REF => 'Les chaussons',
        self::BON_SPOTS_REF => 'Les bon spots',
        self::BONNES_PRATIQUES_REF => 'Les bonnes pratiques'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $reference => $title) {
            $category = new Category();
            $category->setTitle($title);
            $manager->persist($category);
            $this->addReference($reference, $category);
        }

        $manager->flush();
    }
}
