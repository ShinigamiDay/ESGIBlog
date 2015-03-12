<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGI\BlogBundle\Entity\Article;
use ESGI\UserBundle\Entity\User;

class AddArticleFixtures implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;
        $id = 10;

        #region essaiGetUser
        //$repository = $this->getDoctrine()
//                ->getRepository('AcmeStoreBundle:Product');
//            $user = $repository->find($id);
//            $this->container->get('security.context')->getToken()->getUser();
        #endregion

        /* Création d'un user obligatoire qui va être lié aux articles */
        $user = new User();
        $user->setUsername('User name n°');
        $user->setUsernameCanonical('nikosFram');
        $user->setEmail('nicolas.framery.@gmail.com');
        $user->setEmailCanonical('nicolas.framery.@gmail.com');
        $user->setEnabled(true);
        $user->setPassword('nicolas');
        $user->setLocked(false);
        $manager->persist($user);
        $manager->flush();

        while ($i <= 10) {
            $article = new Article();
            $article->setUser($user);
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