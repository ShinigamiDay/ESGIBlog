<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\UserBundle\Entity\User;

class AddUserFixtures implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $user = new User();

            $user->setUsername('User name n°'.$i);
            $user->setUsernameCanonical('nikosFram'.$i);
            $user->setEmail('nicolas.framery.'.$i.'@gmail.com');
            $user->setEmailCanonical('nicolas.framery.'.$i.'@gmail.com');
            $user->setEnabled(true);
            $user->setPassword('nicolas');
            $user->setLocked(false);

            $manager->persist($user);
            $i++;
        }

        $manager->flush();
    }

}