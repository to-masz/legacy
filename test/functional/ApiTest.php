<?php

namespace tomasz\legacy\functional;

use GuzzleHttp\Client;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    public function testUsersEndpoint()
    {
        $client = new Client();

        $result = $client->request('GET', 'http://192.168.99.1:8088/users/me', []);

        $this->assertEquals(200, $result->getStatusCode());
        $resultObject = json_decode($result->getBody()->getContents(), true);
        $this->assertEquals(['id' => 'me'], $resultObject);
    }
}