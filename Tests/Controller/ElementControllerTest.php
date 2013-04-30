<?php

namespace ElsassSeeraiwer\ESBarBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ElementControllerTest extends WebTestCase
{
    public function testToolbarversion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/version');
    }

    public function testToolbaruser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user');
    }

}
