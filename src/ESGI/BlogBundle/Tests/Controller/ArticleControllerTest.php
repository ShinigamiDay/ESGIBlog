<?php

namespace ESGI\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/add');
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
        $this->assertEquals(1, $crawler->filter('a:contains("Toutes")')->count());
        //$this->assertTrue($crawler->filter('article')->count() > 0);

        //Retourne faux
        //$this->assertEquals(1, $crawler->filter('h1:contains("Pingouin et chat")')->count());
    }
}
