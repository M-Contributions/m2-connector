<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces\Protocol;

use Ticaje\Connector\Interfaces\ClientInterface;

/**
 * Interface RestClientInterface
 * @package Ticaje\Connector\Interfaces\Protocol
 */
interface RestClientInterface extends ClientInterface
{
    /**
     * @param $verb
     * @param $endpoint
     * @param array $headers
     * @param array $params
     * @return mixed
     */
    public function request($verb, $endpoint, array $headers = [], array $params);

    /**
     * @param $verb
     * @param $endpoint
     * @param array $headers
     * @param array $params
     * @return mixed
     */
    public function requestAsync($verb, $endpoint, array $headers = [], array $params);
}
