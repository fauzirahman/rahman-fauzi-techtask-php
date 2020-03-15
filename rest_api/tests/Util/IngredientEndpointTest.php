<?php
namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IngredientEndpointTest extends WebTestCase
{
    
    public function testGetIngredient()
    {
        $client = static::createClient();

        $client->request('GET', 'api/ingredients');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowIngredient()
    {
        $client = static::createClient();

        $client->request('GET', 'api/ingredients/1');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
