<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', 'api/recipes?page=1');
        dd($client->getResponse()->getStatusCode());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
