<?php

namespace ESGI\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;

class AddArticleFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        $id = 10;

        while ($i <= 10) {
            $rand = rand(1, 10);
            $article = new Article();
            $article->setUser(
                $this->getReference('user-'.$rand)
            );
            $article->setBody("Article n°".$i);
            $article->setCategory(null);
            $article->setIsPublished(true);
            $article->setTitle('Titre n°'.$i);

            $manager->persist($article);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
