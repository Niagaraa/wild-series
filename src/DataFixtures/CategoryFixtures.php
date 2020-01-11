<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur'
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setColor($faker->hexColor);
            $this->addReference('categorie_' . $key, $category);

            $manager->persist($category);
        }
        $manager->flush();
    }
}