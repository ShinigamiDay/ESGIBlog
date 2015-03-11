<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Category;

class AddCategoryFixtures implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $category = new Category();
            $category->setName('Category n°'.$i);
            $manager->persist($category);
            $i++;
        }

        $manager->flush();
    }

}