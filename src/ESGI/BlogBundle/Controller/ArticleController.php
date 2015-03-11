<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ESGI\BlogBundle\Entity\Article;
use ESGI\BlogBundle\Form\ArticleType;
use ESGI\BlogBundle\Entity\Image;
use ESGI\BlogBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function addAction()
    {

        $article = new Article();

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');

        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            $form->handleRequest($request);

            // Vérifier si les entrées sont correctes
            if ($form->isValid()) {
                // On enregistre l'objet en base de donnée
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.context')->getToken()->getUser();
                $article->setUser($user);
                $em->persist($article);
                $em->flush();

                // On redirige vers la page de visualisation du contenu nouvellement créé
                return $this->redirect($this->generateUrl('see', array('id' => $article->getId())));
            }
        }

        return $this->render('ESGIBlogBundle:Article:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function seeAction(Article $article)
    {
        // Récupération du menu choisi.
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ESGIBlogBundle:Article')
                    ->find($article->getId());

        return $this->render('ESGIBlogBundle:Article:see.html.twig', array(
                'article' => $article
        ));
    }

    public function deleteAction(Article $article)
    {

        $form = $this->createFormBuilder()->getForm();

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // On supprime l'article
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.context')->getToken()->getUser();
                $article->setUser($user);
                $em->remove($article);
                $em->flush();

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');

                // Puis on redirige vers les articles
                return $this->redirect($this->generateUrl('articles'));
            }
        }

        return $this->render('ESGIBlogBundle:Article:delete.html.twig', array(
                'article' => $article,
                'form'    => $form->createView()
            ));
    }

    public function articlesAction($page)
    {
        $numberContentsByPage = 9;
        // Pour récupérer la liste de tous les articles : on utilise findAll()
        // Sinon, on créer une pagination avec un nombre de contenu constant pour chaque page.
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('ESGIBlogBundle:Article')
            ->getArticlesPublished($numberContentsByPage, $page);


        return $this->render('ESGIBlogBundle:Article:articles.html.twig', array(
            'articles' => $articles,
            'page' => $page,
            'numberPage' => ceil(count($articles) / $numberContentsByPage)
            ));
    }

    public function editAction(Article $article)
    {

        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            // Vérifier si les entrées sont correctes
            if ($form->isValid()) {
                // On enregistre l'objet en base de donnée
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.context')->getToken()->getUser();
                $article->setUser($user);
                $em->persist($article);
                $em->flush();

                // On définit un message flash
                $this->get('session')->getFlashBag()->add('info', 'Article bien modifié');
                //On redirige vers la page de visualisation du contenu nouvellement créé
                return $this->redirect($this->generateUrl('see', array('id' => $article->getId())));
            }
        }
    }

}
