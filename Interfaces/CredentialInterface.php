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
     * @param array $params
     * @return CredentialInterface
     */
    public function setParams(array $params): CredentialInterface;
}
