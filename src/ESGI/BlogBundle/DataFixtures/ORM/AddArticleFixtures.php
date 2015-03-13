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
<<<<<<< HEAD
            $article->setBody("Article n°" . $i);
            $article->setCategory(
                $this->getReference('category-' . $rand)
            );
=======
            $article->setBody("Article n°".$i);
            $article->setCategory(null);
>>>>>>> origin/master
            $article->setIsPublished(true);
            $article->setTitle('Titre n°'.$i);
            $article->setImage(
                $this->getReference('img')
            );

            $manager->persist($article);
            $this->addReference('article-' . $i, $article);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
