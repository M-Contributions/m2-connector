<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces\Provider\Token;

/**
 * Interface TokenProviderInterface
 * @package Ticaje\Connector\Interfaces\Provider\Token
 */
interface TokenProviderInterface
{
    /**
     * @param array $params
     * @return TokenProviderInterface
     */
    public function setParams(array $params): TokenProviderInterface;

    /**
     * @return mixed
     */
    public function getAccessToken();
}
