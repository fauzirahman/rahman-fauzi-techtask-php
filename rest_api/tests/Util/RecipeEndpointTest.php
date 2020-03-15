<?php
namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecipeEndpointTest extends WebTestCase
{
    public function testGetRecipe()
    {
        $client = static::createClient();

        $client->request('GET', 'api/recipes');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowRecipe()
    {
        $client = static::createClient();

        $client->request('GET', 'api/recipes/1');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
