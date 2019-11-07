<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {
        return [
            ['/'],
            ['/login'],
            // ...
        ];
    }

    /**
     * @dataProvider provideAnonymousUrls
     */
    public function testAnonymousUser($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isRedirect());
    }

    public function provideAnonymousUrls()
    {
        return [
            ['/admin'],
            ['/logout'],
            // ...
        ];
    }

}
