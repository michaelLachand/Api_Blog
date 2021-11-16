<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
       $fake = Factory::create();

       for($i=0; $i < 10; $i++){
           $user = new User();

          $passHash = $this->hasher->hashPassword($user,'password');

           $user->setEmail($fake->email)
                ->setPassword($passHash);

           $manager->persist($user);

           for($a=0; $a < random_int(3,15); $a++){
               $article = (new Article())->setAuthor($user)
                    ->setContent($fake->text(250))
                    ->setName($fake->text(50));

               $manager->persist($article);
           }
       }

        $manager->flush();
    }
}
