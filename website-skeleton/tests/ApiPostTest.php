<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiPostTest extends WebTestCase
{
    /**
     * @dataProvider provideAnonymousUrls
     */
    public function testGetIsForbidden($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * @dataProvider provideAnonymousUrls
     */
    public function testDeleteIsForbidden($url)
    {
        $client = self::createClient();
        $client->request('DELETE', $url);

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function provideAnonymousUrls()
    {
        return [
            ['/api/post/1'],
            // ...
        ];
    }

}
