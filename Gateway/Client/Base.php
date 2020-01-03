<?php
declare(strict_types=1);

/**
 * Gateway Client Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Client;

use Ticaje\Connector\Interfaces\AuthenticatorInterface;
use Ticaje\Connector\Interfaces\ClientInterface;

/**
 * Class Base
 * @package Ticaje\Connector\Gateway\Client
 */
abstract class Base implements ClientInterface
{
    protected $authenticator;

    protected $client;

    /**
     * Base constructor.
     * @param AuthenticatorInterface $authenticator
     */
    public function __construct(
        AuthenticatorInterface $authenticator
    ) {
        $this->authenticator = $authenticator;
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
