<?php

namespace Geonaute\ActivityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test.json');

        var_dump($client->getResponse()->getContent());
        die();
//        $crawler = $client->request('GET', '/stats/12345.json');

        $this->assertTrue($client->getResponse()->getStatusCode() == 200, 'Request URL is OK');
//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
