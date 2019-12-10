<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $season = new Season();
            $season->setYear($this->faker->numberBetween(1990, 2019));
            $season->setDescription($this->faker->text);
            $season->setNumber($this->faker->randomDigit);
            $season->setProgram($this->getReference('program_' . rand(0, 5)));
            $this->addReference('season_' . $i, $season);

            $manager->persist($season);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}