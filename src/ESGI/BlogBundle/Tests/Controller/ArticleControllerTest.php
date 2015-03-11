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

    public function testArticles()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles');
    }

}
