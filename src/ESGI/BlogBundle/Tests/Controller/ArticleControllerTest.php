<?php

namespace ESGI\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add');

        //$form = $crawler->selectButton('Valider')->form();

    }

    public function testSee()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/see');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

    //Test de l'affichage des articles
    public function testArticles()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/articles');

        //Retourne vrai
        $this->assertEquals(1, $crawler->filter('h1:contains("Welcome to the Article:articles")')->count());

        //Retourne faux
        //$this->assertEquals(1, $crawler->filter('h1:contains("Pingouin et chat")')->count());
    }
}
