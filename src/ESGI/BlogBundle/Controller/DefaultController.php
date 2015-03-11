<?php

namespace ESGI\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	$result = $this->get('esgi_computer')->addition(3, 7);

        return $this->render('ESGIBlogBundle:Default:index.html.twig', array('name' => $name,
        																	 'result' => $result));
    }
}
