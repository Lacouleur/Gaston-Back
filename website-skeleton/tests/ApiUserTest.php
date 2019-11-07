<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiUserTest extends WebTestCase
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient($username = 'user', $password = 'password')
    {
        $client = static::createClient();
        $client->request(
          'POST',
          '/api/login_check',
          array(),
          array(),
          array('CONTENT_TYPE' => 'application/json'),
          json_encode(array(
            'username' => $username,
            'password' => $password,
            ))
          );
      
        $data = json_decode($client->getResponse()->getContent(), true);
      
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));
          
        return $client;
    }

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
            ['/api/user/1'],
            // ...
        ];
    }

    /**
     * @dataProvider provideAuthenticatedUrls
     */
    public function testGetPages($url)
    {
        $client = $this->createAuthenticatedClient('admin', 'admin');
        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // ... 
    }

    public function provideAuthenticatedUrls()
    {
        return [
            ['/api/user/1'],
            // ...
        ];
    }

}