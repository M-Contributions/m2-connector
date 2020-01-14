<?php
declare(strict_types=1);

/**
 * Gateway Client Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Client;

use Ticaje\Base\Application\Factory\FactoryInterface;
use Ticaje\Connector\Interfaces\AuthenticatorInterface;
use Ticaje\Connector\Interfaces\ClientInterface;
use Ticaje\Contract\Patterns\Interfaces\Decorator\ResponderInterface;

/**
 * Class Base
 * @package Ticaje\Connector\Gateway\Client
 */
abstract class Base implements ClientInterface
{
    protected $authenticator;

    protected $client;

    protected $clientFactory;

    protected $responder;

    /**
     * Base constructor.
     * @param AuthenticatorInterface $authenticator
     * @param ResponderInterface $responder
     * @param FactoryInterface $clientFactory
     */
    public function __construct(
        AuthenticatorInterface $authenticator,
        ResponderInterface $responder,
        FactoryInterface $clientFactory
    ) {
        $this->authenticator = $authenticator;
        $this->responder = $responder;
        $this->clientFactory = $clientFactory;
    }

    /**
     * @inheritDoc
     */
    public function authenticate($credentials)
    {
        $permission = null;
        try {
            $this->authenticator->authenticate($credentials);
            $permission = $this->authenticator->getPermission();
        } catch (\Exception $exception) {
        }
        return $permission;
    }

    public function getAuthOptions()
    {
        return $this->authenticator->generateAuthOptions();
    }
}
