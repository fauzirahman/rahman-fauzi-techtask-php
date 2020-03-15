<?php
namespace App\Tests\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LunchEndpointTest extends WebTestCase
{    
    public function testShowLunch()
    {
        $client = static::createClient();

        $client->request('GET', 'api/lunch');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
