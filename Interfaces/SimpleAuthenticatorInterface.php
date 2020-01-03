<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces;

/**
 * Interface SimpleAuthenticatorInterface
 * @package Ticaje\Connector\Interfaces
 */
interface SimpleAuthenticatorInterface
{
    /**
     * @param array $credentials
     * @return mixed
     */
    public function authenticate(array $credentials);

    /**
     * @return mixed
     */
    public function generateClients();
}
