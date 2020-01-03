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
 * Interface AuthenticatorInterface
 * @package Ticaje\Connector\Interfaces
 */
interface AuthenticatorInterface extends SimpleAuthenticatorInterface
{
    /**
     * @return mixed
     */
    public function generateAuthOptions();

    /**
     * @return mixed
     * If, in the long run, it turns out that no permission is needed for non oauth authentication providers
     * then for the sake of I.S.P we should move this method onto another interface
     */
    public function getPermission();
}
