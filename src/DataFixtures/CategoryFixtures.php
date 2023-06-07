<?php

namespace App\DataFixtures;

use App\Entity\Post\Category;
use App\Repository\Post\PostRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private PostRepository $postRepository)
    {
    }

    public function load(ObjectManager $manager) : void
    {
        $faker = Factory::create('fr_FR');
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->words(1,true).''.$i);
            $category->setDescription(mt_rand(0, 1) ? $faker->realText(100) : null);
            $manager->persist($category);
            $categories[] = $category;
        }


                // rajouter des catégories aux articles
        $posts = $this->postRepository->findAll();

        foreach ($posts as $post) {
            //1 à 5 categories par post
            for ($i=0;$i<mt_rand(1,5); $i++){
                $post->addCategory($categories[mt_rand(0, count($categories) - 1)]);
                $manager->persist($post);
            }

        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PostFixtures::class
        ];
    }
}
