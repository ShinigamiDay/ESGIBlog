<?php

namespace ESGI\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;

class AddUserFixtures extends AbstractFixture implements OrderedFixtureInterface
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
            $this->addReference('user-' . $i, $user);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}