<?php
declare(strict_types=1);

/**
 * Gateway Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Provider\Authentication;

use Ticaje\Connector\Interfaces\Provider\Authentication\AuthenticatorInterface;

/**
 * Class Basic
 * @package Ticaje\Connector\Gateway\Provider\Authentication
 */
class Basic implements AuthenticatorInterface
{
    /**
     * @inheritDoc
     */
    public function authenticate(array $credentials)
    {
    }
}
