<?php

namespace ESGI\BlogBundle\Controller;

use ESGI\BlogBundle\Entity\SuggestArticle;
use ESGI\BlogBundle\Form\SuggestArticleType;
use ESGI\BlogBundle\Entity\Article;
use ESGI\BlogBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class ArticleController extends FOSRestController
{
    public function addAction()
    {
        $article = new Article();
        $categories = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->findAll();
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
            'categories' => $categories,
        ));
    }

    public function seeAction(Article $article)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->findAll();
        // Récupération du menu choisi.
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ESGIBlogBundle:Article')
                    ->find($article->getId());

        return $this->render('ESGIBlogBundle:Article:see.html.twig', array(
                'article' => $article, 
                'categories' => $categories,

        ));
    }

    public function deleteAction(Article $article)
    {
        $categories = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->findAll();
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
                'form'    => $form->createView(),
                'categories' => $categories,
            ));
    }

    /**
     * Fetch all articles published with pagination.
     *
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlesAction($page, $id)
    {
        $numberContentsByPage = 3;
        // Pour récupérer la liste de tous les articles : on utilise findAll()
        // Sinon, on créer une pagination avec un nombre de contenu constant pour chaque page.

        $articles = null;
        $categories = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->findAll();

        if ($id === 0)
        {
            $articles = $this->getDoctrine()
                ->getManager()
                ->getRepository('ESGIBlogBundle:Article')
                ->getArticlesPublished($numberContentsByPage, $page);
        } else {
            $category = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->find($id);
            $articles =  $this->getDoctrine()->getManager()
                ->getRepository('ESGIBlogBundle:Article')
                ->getArticlesPublishedCategory($numberContentsByPage, $page, $category);
        }


        /*
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('ESGIBlogBundle:Article')
            ->getArticlesPublished($numberContentsByPage, $page);*/

        return $this->render('ESGIBlogBundle:Article:articles.html.twig', array(
            'articles' => $articles,
            'categories' => $categories,
            'page' => $page,
            'numberPage' => ceil(count($articles) / $numberContentsByPage),
        ));
    }

    public function suggestAction($page)
    {
        $numberContentsByPage = 9;
        // Pour récupérer la liste de tous les articles : on utilise findAll()
        // Sinon, on créer une pagination avec un nombre de contenu constant pour chaque page.
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('ESGIBlogBundle:SuggestArticle')
            ->getArticlesPaginator($numberContentsByPage, $page);

        return $this->render('ESGIBlogBundle:Article:suggest.html.twig', array(
            'articles' => $articles,
            'page' => $page,
            'numberPage' => ceil(count($articles) / $numberContentsByPage),
            'categories' => $categories,
        ));
    }

    public function suggestArticleAction()
    {
        $suggestArticle = new SuggestArticle();

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new SuggestArticleType(), $suggestArticle);

        $request = $this->get('request');

        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            $form->handleRequest($request);

            // Vérifier si les entrées sont correctes
            if ($form->isValid()) {
                // On enregistre l'objet en base de donnée
                $em = $this->getDoctrine()->getManager();
                $em->persist($suggestArticle);
                $em->flush();

                // On redirige vers la page de visualisation du contenu nouvellement créé
                return $this->redirect($this->generateUrl('suggest', array('id' => $suggestArticle->getId())));
            }
        }

        return $this->render('ESGIBlogBundle:Article:addSuggestArticle.html.twig', array(
            'form' => $form->createView(),
            'categories' => $categories,
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

        return $this->render('ESGIBlogBundle:Article:edit.html.twig', array(
            'article' => $article,
            'form'    => $form->createView(),
            'categories' => $categories,
        ));
    }


    public function searchAction() {

        $numberContentsByPage = 3;
        $page = 1;

        $request = $this->get('request');
        $categories = $this->getDoctrine()->getManager()->getRepository("ESGIBlogBundle:Category")->findAll();
        $articles = null;
        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            $key = $request->request->get('key', '');

            // Sinon, on créer une pagination avec un nombre de contenu constant pour chaque page.
            $articles = $this->getDoctrine()
                ->getManager()
                ->getRepository('ESGIBlogBundle:Article')
                ->getArticlesWithKey($key);
        }

        return $this->render('ESGIBlogBundle:Article:results.html.twig', array(
            'articles' => $articles,
            'categories' => $categories,
        ));

        //return $this->redirect($this->generateUrl('articles'));
    }
}
