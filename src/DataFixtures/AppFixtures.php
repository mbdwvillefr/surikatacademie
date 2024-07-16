<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                'securepassword'
            )
        );

        $user->setRoles(['ROLE_USER']);
        
        $manager->persist($user);

        $manager->flush();
    }
}
