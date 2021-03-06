<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $this->faker = Factory::create();

        for ($i = 0; $i < 200; $i++) {
            $episode = new Episode();
            $episode->setTitle($this->faker->text(50));
            $episode->setNumber($this->faker->randomDigit);
            $episode->setSynopsis($this->faker->text);

            $episode->setSeason($this->getReference('season_' . rand(0,9)));
            $this->addReference('episode_' . $i, $episode);
            $episode->setSlug($slugify->generate($episode->getTitle()));

            $manager->persist($episode);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}