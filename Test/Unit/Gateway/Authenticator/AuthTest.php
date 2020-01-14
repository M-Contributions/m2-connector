<?php
declare(strict_types=1);

/**
 * Test Suite
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Test\Unit\Gateway\Authenticator;

use Error;
use TypeError;

use Ticaje\Connector\Gateway\Authenticator\Oauth;
use Ticaje\Connector\Interfaces\AuthenticatorInterface;
use Ticaje\Connector\Test\Unit\BaseTest;

/**
 * Class ConnectionTest
 * @package Ticaje\Connector\Test\Unit\Gateway\Authenticator
 */
class AuthTest extends BaseTest
{
    private $authenticator;

    public function setUp()
    {
        parent::setUp();
        $this->authenticator = $this->objectManager->getObject(Oauth::class, ['authType' => 'oauth']);
    }

    public function testInstanceOfOauth()
    {
        $this->assertInstanceOf(AuthenticatorInterface::class, $this->authenticator);
    }

    public function testAuthenticate()
    {
        $this->expectException(TypeError::class, 'Asserting that must fail when passed bad credentials along');
        $this->authenticator->authenticate(['tokenUri' => '', 'consumerKey' => '', 'consumerPassword' => '', 'grand_type' => '']);
    }

    public function testGenerateAuthOptions()
    {
        $this->expectException(TypeError::class, 'Asserting that must fail when no oauthMiddlewareClient still generated');
        $this->authenticator->generateAuthOptions();
    }

    public function testGetPermission()
    {
        $this->expectException(Error::class, 'Asserting that must fail when no oauthMiddlewareClient still generated');
        $this->assertNull($this->authenticator->getPermission());
    }

    public function testGenerateClients()
    {
        $this->assertNull($this->authenticator->generateClients(), 'Asserting that null must be returned when no clients yet');
    }
}
