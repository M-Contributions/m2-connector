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
 * Interface SoapClientInterface
 * @package Ticaje\Connector\Interfaces\Protocol
 */
interface SoapClientInterface extends ClientInterface
{
    /**
     * @param $operation
     * @param array $params
     * @return mixed
     */
    public function request($operation, array $params = []);
}
