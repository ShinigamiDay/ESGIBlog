<?php

namespace ESGI\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testGetcategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getCategories');
    }

    public function testPostcategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postCategories');
    }

    public function testPutcategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/putCategory');
    }

}
