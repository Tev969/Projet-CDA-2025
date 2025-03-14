<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;


class UsersFixtures extends Fixture
{
    public function __construct(private PasswordHasherFactoryInterface $passwordHasherFactory) {
    }
    public function load(ObjectManager $manager): void
    {
        $password = $this->passwordHasherFactory->getPasswordHasher(User::class)->hash('password');
        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Admin');
        $user->setLastname('Admin');

        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('User');
        $user->setLastname('User');

        $user = new User();
        $user->setEmail('coach@example.com');
        $user->setPassword($password);
        $user->setRoles(['ROLE_COACH']);
        $user->setFirstname('Coach');
        $user->setLastname('Coach');

        $manager->persist($user);
        $manager->flush();
    }
}
