<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Article;

class AddArticleFixtures implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {

            $article = new Article();
            $article->setAuthor('nico N°' . $i);
            $article->setBody("Article n°" . $i);
            $article->setCategory(null);
            $article->setIsPublished(true);
            $article->setTitle('Titre n°'.$i);

            $manager->persist($article);
            $i++;
        }

        $manager->flush();
    }
}