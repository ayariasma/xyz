<?php

namespace MyApp\ParcBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MarqueControllerTest extends WebTestCase
{
    public function testAjout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Ajout');
    }

    public function testAffichage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affichage');
    }

}
