<?php
declare(strict_types=1);

/**
 * Test Suite
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Test\Unit\Gateway\Client;

use Ticaje\Connector\Gateway\Provider\Credentials;
use Ticaje\Connector\Interfaces\Protocol\FtpClientInterface;
use Ticaje\Connector\Test\Unit\BaseTest;
use Ticaje\Connector\Gateway\Client\Ftp;

/**
 * Class ConnectionTest
 * @package Ticaje\Connector\Test\Unit\Gateway\Client
 */
class FtpConnectionTest extends BaseTest
{
    private $client;

    private $credentials;

    public function setUp()
    {
        parent::setUp();
        $this->client = $this->getMockBuilder(Ftp::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->credentials = $this->objectManager->getObject(Credentials::class);
    }

    public function testInstantiateRestClient()
    {
        $this->assertInstanceOf(FtpClientInterface::class, $this->client);
    }

    public function testWrongCredentials()
    {
        $credentials = [
            'username' => 'user',
            'password' => 'password',
            'host' => 'localhost',
            'port' => 22,

        ];
        $result = null;
        $this->credentials->set($credentials);
        $this->client->expects($this->once())
            ->method('connect')
            ->will($this->returnValue(false));
        $result = $this->client->connect($this->credentials);
        $this->assertFalse($result);

        $this->client->expects($this->once())
            ->method('isConnected')
            ->will($this->returnValue(false));
        $connected = $this->client->isConnected();
        $this->assertFalse($connected, "Assert disconnected after fail");
    }
}
