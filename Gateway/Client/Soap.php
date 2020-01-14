<?php
declare(strict_types=1);

/**
 * Gateway Client Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Client;

use Ticaje\Connector\Interfaces\Protocol\SoapClientInterface;

/**
 * Class Soap
 * @package Ticaje\Connector\Gateway\Client
 */
class Soap extends Base implements SoapClientInterface
{
    /**
     * @inheritDoc
     */
    public function generateClient($credentials)
    {
        $config = ['options' => $this->authenticate($credentials), 'wsdl' => $credentials['wsdl']];
        $this->client = $this->clientFactory->create($config);
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function request($operation, array $params = [])
    {
        // TODO: Implement request() method.
    }
}
