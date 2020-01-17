<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces\Provider\Authentication;

/**
 * Interface OAuthInterface
 * @package Ticaje\Connector\Interfaces\Provider\Authentication
 */
interface OAuthInterface
{
    /**
     * @return string
     */
    public function getAccessToken(): string;
}
