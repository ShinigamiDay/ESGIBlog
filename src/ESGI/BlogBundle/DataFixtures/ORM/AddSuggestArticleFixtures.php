<?php

namespace ESGI\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\SuggestArticle;
use Doctrine\Common\DataFixtures\AbstractFixture;

class AddSuggestArticleFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $rand = rand(1, 10);

            $sugArticle = new SuggestArticle();
            $sugArticle->setTitle('Article suggéré n°'.$i);
            $sugArticle->setBody('Corps de l article n°'.$i);
            $sugArticle->setCategory(
                $this->getReference('category-' . $rand)
            );

            $manager->persist($sugArticle);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}