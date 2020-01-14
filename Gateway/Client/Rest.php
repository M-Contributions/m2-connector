<?php
declare(strict_types=1);

/**
 * Gateway Client Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Client;

use Ticaje\Connector\Interfaces\Protocol\RestClientInterface;
use Ticaje\Connector\Traits\Gateway\Client\Rest as RestTrait;

/**
 * Class Rest
 * @package Ticaje\Connector\Gateway\Client
 */
class Rest extends Base implements RestClientInterface
{
    use RestTrait;

    protected $accessToken;

    /**
     * @inheritDoc
     */
    public function generateClient($credentials)
    {
        $this->accessToken = $this->accessToken ?: $this->authenticate($credentials);
        if (!$this->accessToken) {
            return null;
        }
        // If auth problems the log and return void
        $this->client = $this->clientFactory->create([
            'config' => [ // Playing a little bit with Magento rules by passing config key, must ve refactored
                'base_uri' => $credentials['base_uri']
            ]
        ]);
        return $this->client;
    }

    /**
     * @param $headers
     * @return array
     * This method should be abstracted away into a builder class
     */
    protected function generateHeaders($headers)
    {
        $authTokenHeader = ["Authorization" => "{$this->accessToken}"];
        return array_merge($headers, $authTokenHeader);
    }
}
