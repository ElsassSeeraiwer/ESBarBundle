<?php

namespace Elsass\SeeraiwerBarBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ToolbarControllerTest extends WebTestCase
{
    public function testToolbarjs()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/toolbarJs');
    }

}
