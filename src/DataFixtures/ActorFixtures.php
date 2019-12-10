<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface

{
    const ACTORS = [
        'Andrew Lincoln',
        'Norman Reedus',
        'Lauren Cohan',
        'Danai Gurira',
    ];

    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        foreach (self::ACTORS as $key => $name) {
            $actor = new Actor();
            $actor->setName($name);

            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_0'));
        }

        for ($i = 0; $i < 20 ; $i++) {
            $actor = new Actor();
            $actor->setName($this->faker->name);
            $this->addReference('actor_' . $i, $actor);
            $actor->addProgram($this->getReference('program_' . rand(0,5)));

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}