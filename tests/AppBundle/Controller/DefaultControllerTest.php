<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $body = $crawler->filter('div.container');
        $navigation = $body->filter('nav.navbar');
        $this->assertContains('Pagetitle', $navigation->text());
        $this->assertContains('Home', $navigation->text());
        $this->assertContains('About', $navigation->text());
        $this->assertContains('Contact', $navigation->text());
        $content = $body->filter('div.starter-template');
        $this->assertContains('Bootstrap starter template', $content->text());
    }
}
