<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESGI\BlogBundle\Entity\Category;
use ESGI\BlogBundle\Form\CategoryType;

class CategoryController extends Controller
{
    public function getCategoriesAction()
    {
        $categories = $this->getDoctrine()->getRepository("ESGIBlogBundle:Category");

        return $this->render('ESGIBlogBundle:Category:categories.html.twig', array(
                'categories' => $categories,
            ));
    }

    public function postCategoriesAction()
    {
        $category = new Category();

        // On crée le FormBuilder grâce à la méthode du contrôleur
        $form = $this->createForm(new CategoryType(), $category);

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
                $category->setUser($user);
                $em->persist($category);
                $em->flush();

                // On redirige vers la page de visualisation du contenu nouvellement créé
                return $this->redirect($this->generateUrl('see', array('id' => $category->getId())));
            }
        }

        return $this->render('ESGIBlogBundle:Category:add.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    public function putCategoryAction()
    {
        return $this->render('ESGIBlogBundle:Category:edit.html.twig', array(
                // ...
            ));
    }
}
