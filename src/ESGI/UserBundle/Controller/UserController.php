<?php

namespace ESGI\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ESGI\UserBundle\Entity\User;
//use ESGI\UserBundle\Form\Type\ProfileEditFormType;
use ESGI\UserBundle\Form\Type\RegistrationFormType;
//use ESGI\UserBundle\Form\Type\UserEditFormType;
//use ESGI\UserBundle\Form\Type\ChangePasswordFormType;

class UserController extends Controller
{
    /**
     * @Route("/registration")
     * @Template()
     */
    public function registrationAction()
    {

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $form = $this->createForm(new RegistrationFormType(), $user);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                // On active directement l'utilisateur sans qu'il n'ait besoin d'activer son compte
                $user->setEnabled(true);
                $userManager->updateUser($user);
            }
        }

        return array(
                // ...
            );
    }

}
