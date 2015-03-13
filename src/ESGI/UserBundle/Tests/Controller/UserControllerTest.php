<?php

namespace ESGI\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/registration');
    }

    public function subscribe()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        // définit certaines valeurs
        $form['fos_user_registration_form_username'] = 'cybard';
        $form['fos_user_registration_form_email'] = 'nicolas.cybard4@gmail.com';
        $form['fos_user_registration_form_plainPassword_first'] = 'nicolas';
        $form['fos_user_registration_form_plainPassword_second'] = 'nicolas';

        // soumet le formulaire
        $crawler = $client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("The user has been created successfully")')->count());
    }

}
