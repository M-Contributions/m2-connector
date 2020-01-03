<?php
declare(strict_types=1);

/**
 * Gateway Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Authenticator;

use Ticaje\Connector\Interfaces\AuthenticatorInterface;

/**
 * Class Basic
 * @package Ticaje\Connector\Gateway\Authenticator
 */
class Basic implements AuthenticatorInterface
{
    /**
     * @inheritDoc
     */
    public function generateAuthOptions()
    {
    }

    /**
     * @inheritDoc
     */
    public function authenticate(array $credentials)
    {
    }

    /**
     * @inheritDoc
     */
    public function generateClients()
    {
    }

    /**
     * @inheritDoc
     */
    public function getPermission()
    {
    }
}
