<?php
declare(strict_types=1);

/**
 * Test Suite
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Test\Unit\Gateway\Client;

use Ticaje\Connector\Test\Unit\BaseTest;
use Ticaje\Connector\Interfaces\Protocol\RestClientInterface;
use Ticaje\Connector\Gateway\Client\Rest;

/**
 * Class ConnectionTest
 * @package Ticaje\Connector\Test\Unit\Gateway\Client
 */
class ConnectionTest extends BaseTest
{
    private $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = $this->objectManager->getObject(Rest::class);
    }

    public function testInstantiateRestClient()
    {
        $this->assertInstanceOf(RestClientInterface::class, $this->client);
    }

    public function testAuthenticate()
    {
        $this->assertNull($this->client->authenticate([]), 'Assert that passing no credentials returns null');
    }

    public function testGenerateClient()
    {
        $this->assertNull($this->client->generateClient([]), 'Assert that passing no credentials returns null');
    }
}