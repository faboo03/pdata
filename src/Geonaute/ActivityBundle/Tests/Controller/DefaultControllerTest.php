<?php

namespace Geonaute\ActivityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testPost()
    {
        $client = static::createClient();

//        $data = array('activity_token' => '8d5d38a59c72e5f3fa12', 'product_ids' => array('0987654321' ,'1098765432'));
//        $jsonData = json_encode($data);
//        $crawler = $client->request('POST', '/activity.json', array(), array(), array(), $jsonData);

//        $this->assertTrue($client->getResponse()->getStatusCode() == 200, 'Request URL is OK');
    }

    public function testList()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/stats/0987654321.json');

        var_dump($client->getResponse()->getContent());
        die();
        $this->assertTrue($client->getResponse()->getStatusCode() == 200, 'Request URL is OK');
    }

}
