<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\SerializerBundle\JMSSerializerBundle;
use ESGI\BlogBundle\Entity\Article;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleRestController extends FOSRestController
{

    /**
     * Fetch all articles published.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Fetch all articles published.",
     *  filters={
     *      {"name"="a-filter", "dataType"="integer"},
     *      {"name"="another-filter", "dataType"="string", "pattern"="(foo|bar) ASC|DESC"}
     *  }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArticlesAction()
    {
        // Pour récupérer la liste de tous les articles : on utilise findAll()
        // Sinon, on créer une pagination avec un nombre de contenu constant pour chaque page.
        $articles = $this->getDoctrine()
            ->getManager()
            ->getRepository('ESGIBlogBundle:Article')
            ->findByIsPublished(true);

        $datas =  array('articles' => $articles);

        $view = $this->view($datas, 200)
            ->setTemplate("ESGIBlogBundle:Article:articles.html.twig")
            ->setTemplateVar('articles')
        ;

        return $this->handleView($view);
    }

    /**
     * Create a new Article.
     * @ApiDoc(
     *  description="Create a new Article",
     *  input="ESGI\BlogBundle\Form\Type\ArticleType",
     *  output="ESGI\BlogBundle\Article"
     * )
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postArticlesAction()
    {

        $article = new Article();

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');
        $code = 400;

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
                $code = 200;

            } else { $code = 400; }
        } else { $code = 400; }

        $datas =  array('form' => $form);

        $view = $this->view($datas, $code)
            ->setTemplate("ESGIBlogBundle:Article:articles.html.twig")
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Create a new Article",
     *  input="ESGI\BlogBundle\Form\Type\ArticleType",
     *  output="ESGI\BlogBundle\Article"
     * )
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putArticleAction(Article $article)
    {

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');
        $code = 400;

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
                $code = 200;

            } else { $code = 400; }
        } else { $code = 400; }

        $datas =  array('form' => $form);

        $view = $this->view($datas, $code)
            ->setTemplate("ESGIBlogBundle:Article:articles.html.twig")
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }
}
