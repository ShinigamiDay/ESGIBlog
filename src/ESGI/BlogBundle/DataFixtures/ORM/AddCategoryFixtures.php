<?php

namespace ESGI\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Category;

class AddCategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $rand = rand(1, 10);
            $category = new Category();
            $category->setName('Category n°'.$i);
            $category->setUser(
                $this->getReference('user-' . $rand)
            );
            $manager->persist($category);
            $this->addReference('category-' . $i, $category);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}