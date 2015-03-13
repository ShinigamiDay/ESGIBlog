<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Category;
use ESGI\UserBundle\Entity\User;

class AddCategoryFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        /* Création d'un user obligatoire qui va être lié aux articles */
        $user = new User();
        $user->setUsername('User n°');
        $user->setUsernameCanonical('nikosm');
        $user->setEmail('nicolas@gmail.com');
        $user->setEmailCanonical('nicolas@gmail.com');
        $user->setEnabled(true);
        $user->setPassword('nicola');
        $user->setLocked(false);
        $manager->persist($user);
        $manager->flush();

        while ($i <= 10) {
            $category = new Category();
            $category->setName('Category n°'.$i);
            $category->setUser($user);
            $manager->persist($category);
            $i++;
        }

        $manager->flush();
    }
}
