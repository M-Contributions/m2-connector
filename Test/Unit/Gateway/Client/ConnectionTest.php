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
        $this->client = $this->objectManager->getObject(Rest::class, ['baseUriKey' => RestClientInterface::BASE_URI_KEY]);
    }

    public function testInstantiateRestClient()
    {
        $this->assertInstanceOf(RestClientInterface::class, $this->client);
    }
}
