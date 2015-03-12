<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESGI\BlogBundle\Entity\Comment;
use ESGI\BlogBundle\Form\CommentType;

class CommentController extends Controller
{

    public function postCommentsAction($id)
    {

        $comment = new Comment();

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new CommentType(), $comment);

        $request = $this->get('request');

        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            $form->handleRequest($request);

            // Vérifier si les entrées sont correctes
            if ($form->isValid()) {
                // On enregistre l'objet en base de donnée
                $em = $this->getDoctrine()->getManager();
                $article = $this->getDoctrine()
                                ->getRepository('ESGIBlogBundle:Article')
                                ->find($id);
                
                // On ajoute le commentaire seulement si c'est autorisé.
                if ($article->getIsCommented())
                {
                    $comment->setArticle($article);
                    $user = $this->container->get('security.context')->getToken()->getUser();
                    $comment->setUser($user);
                    $em->persist($comment);
                    $em->flush();
                }

                // On redirige vers la page de visualisation de l'article nouvellement créé
                return $this->redirect($this->generateUrl('see', array('id' => $article->getId())));
            }
        }

        return $this->render('ESGIBlogBundle:Comment:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function putCommentAction(Comment $comment)
    {

        $form = $this->createForm(new CommentType(), $comment);

        $request = $this->get("request");

        if($request->getMethod() == "POST")
        {
            $form->handleRequest($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $user = $this->container->get('security.context')->getToken()->getUser();
                $comment->setUser($user);
                $em->persist($comment);
                $em->flush();
            }
        }

        return $this->render('ESGIBlogBundle:Comment:edit.html.twig', array(
            'form' => $form->createView(),
            'comment' => $comment
        ));
    }

}
