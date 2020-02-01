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
 * Interface CredentialInterface
 * @package Ticaje\Connector\Interfaces
 */
interface CredentialInterface
{
    /**
     * @param array $credentials
     * @return CredentialInterface
     */
    public function set(array $credentials): CredentialInterface;

    /**
     * @return mixed
     * Returns credentials as associative array
     */
    public function getAll(): array;
}
