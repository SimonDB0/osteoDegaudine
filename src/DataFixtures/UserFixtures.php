<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('admin@admin.be')
            ->setLastname('De Boe')
            ->setFirstname('Simon')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword(
                $this->hasher->hashPassword(
                    $admin,
                    'password'
                )

            );
        $manager->persist($admin);

        for ($i = 0; $i < 15; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
                ->setLastname($faker->lastname())
                ->setFirstname($faker->firstname())
                ->setPassword(
                    $this->hasher->hashPassword(
                        $user,
                        'password'
                    )
                );


            $manager->persist($user);
        }

        $manager->flush();
    }
}
