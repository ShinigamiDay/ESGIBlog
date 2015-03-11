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
            $manager->persist($user);
            $i++;
        }

        $manager->flush();
    }

}