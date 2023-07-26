<?php

namespace App\DataFixtures;

use App\Entity\Post\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Utilisation de Faker pour générer des données aléatoires en français
        $faker = Factory::create('fr_FR');

        // Génération de 30 entités "Post"
        for ($i = 0; $i < 30; $i++) {
            $post = new Post();

            // Attribution de valeurs aléatoires aux propriétés de l'entité "Post"
            $post->setTitle($faker->sentence(mt_rand(3, 6))) // Génération d'un titre avec 3 à 6 mots
            ->setContent($faker->realText(1800)) // Génération d'un contenu texte de 1800 caractères
            ->setState(mt_rand(0, 2) === 1 ? Post::STATES[0] : Post::STATES[1]) // Attribution d'un état aléatoire (soit le premier état, soit le second)
            ->setAttachment('sim.jpg'); // Attribution d'une image de pièce jointe (simulée ici avec 'sim.jpg')

            // Persistance de l'entité "Post" pour qu'elle soit ajoutée à la base de données
            $manager->persist($post);
        }

        // Exécution des opérations de persistance en base de données
        $manager->flush();
    }
}