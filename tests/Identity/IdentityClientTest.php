<?php
declare(strict_types=1);

namespace Serato\SwsSdk\Test\Identity;

use Serato\SwsSdk\Test\AbstractTestCase;
use Serato\SwsSdk\Identity\IdentityClient;
use Serato\SwsSdk\Sdk;

class IdentityClientTest extends AbstractTestCase
{
    const ID_SERVER_BASE_URI = 'http://id.server.com';

    public function testGetBaseUri()
    {
        $client = new IdentityClient(
            [
                Sdk::BASE_URI => [
                    Sdk::BASE_URI_ID        => self::ID_SERVER_BASE_URI,
                    Sdk::BASE_URI_LICENSE   => 'http://license.server.com',
                    Sdk::BASE_URI_PROFILE   => 'https://profile.server.com',
                    Sdk::BASE_URI_ECOM      => 'http://ecom.server.com'
                ]
            ],
            'my_app',
            'my_pass'
        );

        $this->assertEquals(self::ID_SERVER_BASE_URI, $client->getBaseUri());
    }

    /* The remaining tests are smoke tests for each magic method provided by the client */

    public function testGetUser()
    {
        $body = '{"var1":"val1"}';
        $client = $this->getSdkWithMocked200Response($body)->createIdentityClient();
        $result = $client->getUser();
        $this->assertEquals((string)$result->getResponse()->getBody(), $body);
    }

    public function testGetUsers()
    {
        $body = '{"var1":"val1"}';
        $client = $this->getSdkWithMocked200Response($body)->createIdentityClient();
        $result = $client->getUsers([]);
        $this->assertEquals((string)$result->getResponse()->getBody(), $body);
    }

    public function testUserAddGaClientId()
    {
        $body = '{"var1":"val1"}';
        $client = $this->getSdkWithMocked200Response($body)->createIdentityClient();
        $result = $client->userAddGaClientId(['user_id' => 123, 'ga_client_id' => 'abc']);
        $this->assertEquals((string)$result->getResponse()->getBody(), $body);
    }

    public function testTokenExchange()
    {
        $body = '{"var1":"val1"}';
        $client = $this->getSdkWithMocked200Response($body)->createIdentityClient();
        $result = $client->tokenExchange(['grant_type' => 'boo', 'code' => 'abc', 'redirect_uri' => 'uri']);
        $this->assertEquals((string)$result->getResponse()->getBody(), $body);
    }

    public function testTokenRefresh()
    {
        $body = '{"var1":"val1"}';
        $client = $this->getSdkWithMocked200Response($body)->createIdentityClient();
        $result = $client->tokenRefresh(['refresh_token' => 'str']);
        $this->assertEquals((string)$result->getResponse()->getBody(), $body);
    }
}
