<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(3))
                   ->setDescription($faker->paragraphs(3, true))
                   ->setImage($faker->imageUrl(640, 480, 'program'));

            $manager->persist($program);
        }

        $manager->flush();
    }
}
