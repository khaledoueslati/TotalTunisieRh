<?php

namespace App\T360Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class T360GrilleControllerTest extends WebTestCase
{
    public function testGetgrille()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getGrille');
    }

}
