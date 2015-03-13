<?php

namespace ESGI\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;

class AddCommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 10) {
            $rand = rand(1, 10);

            $comment = new Comment();
            $comment->setUser(
                $this->getReference('user-' . $rand)
            );
            $comment->setContent('content n°'.$i);
            $comment->setArticle(
                $this->getReference('article-' . $rand)
            );

            $manager->persist($comment);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
