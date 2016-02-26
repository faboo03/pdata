<?php

namespace Geonaute\ActivityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
//    public function testIndex()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/test.json');
//
//        var_dump($client->getResponse()->getContent());
////        $crawler = $client->request('GET', '/stats/12345.json');
//
//        $this->assertTrue($client->getResponse()->getStatusCode() == 200, 'Request URL is OK');
////        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
//    }

    public function testPost()
    {
        $client = static::createClient();

        $data = array('activity_token' => 'testActivity', 'product_ids' => array('0987654321' ,'1098765432'));
        $jsonData = json_encode($data);
        $crawler = $client->request('POST', '/activity.json', array(), array(), array(), $jsonData);

        var_dump($client->getResponse()->getContent());
        die();

        $this->assertTrue($client->getResponse()->getStatusCode() == 200, 'Request URL is OK');
//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }

//    public function testList()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/stats/12345.json?start=2016-02-27');
//
//        var_dump($client->getResponse()->getContent());
//        die();
////        $crawler = $client->request('GET', '/stats/12345.json');
//
////        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
//    }
}
