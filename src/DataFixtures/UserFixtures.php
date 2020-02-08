<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // Création d’un utilisateur de type “auteur”
        $subscriber = new User();

        $subscriber->setEmail('member@gmail.com');
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setUsername('John Doe');
        $subscriber->setPicture($faker->imageUrl(200,200, 'people'));
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            'memberpass'
        ));

        $manager->persist($subscriber);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('Hayley Marshall');
        $admin->setPicture($faker->imageUrl(200,200, 'people'));
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpass'
        ));

        $manager->persist($admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
    }
}
