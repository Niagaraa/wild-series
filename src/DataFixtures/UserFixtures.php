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
        $member = new User();

        $member->setEmail('member@gmail.com');
        $member->setRoles(['ROLE_member']);
        $member->setUsername('John Doe');
        $member->setPicture($faker->imageUrl(200,200));
        $member->setPassword($this->passwordEncoder->encodePassword(
            $member,
            'memberpassword'
        ));

        $manager->persist($member);

        // Création d’un utilisateur de type “administrateur”
        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('Eleanor Shellstrop');
        $admin->setPicture($faker->imageUrl(200,200));
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
    }
}
