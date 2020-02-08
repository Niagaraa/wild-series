<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use App\Service\Slugify;
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
        $slugify = new Slugify();
        $faker = Factory::create();

        foreach (self::ACTORS as $key => $name) {
            $actor = new Actor();
            $actor->setName($name);
            $actor->setSlug($slugify->generate($actor->getName()));

            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_0'));
        }

        for ($i = 0; $i < 10 ; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->setSlug($slugify->generate($actor->getName()));

            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_' . rand(0,5)));
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}