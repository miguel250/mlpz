<?php

namespace MZ\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{

    public function testIndex()
    {
       $client = self::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertRegexp('/\d+ Bundles/', str_replace("\n", '', trim($crawler->filter('h1')->text())));
    }

}
