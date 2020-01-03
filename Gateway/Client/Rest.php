<?php
declare(strict_types=1);

/**
 * Gateway Client Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Client;

use Ticaje\Base\Application\Factory\FactoryInterface;
use Ticaje\Connector\Interfaces\AuthenticatorInterface;
use Ticaje\Connector\Interfaces\Protocol\RestClientInterface;
use Ticaje\Connector\Traits\Gateway\Client\Rest as RestTrait;

/**
 * Class Rest
 * @package Ticaje\Connector\Gateway\Client
 */
class Rest extends Base implements RestClientInterface
{
    use RestTrait;

    protected $clientFactory;

    protected $accessToken;

    /**
     * Rest constructor.
     * @param AuthenticatorInterface $authenticator
     * @param $clientFactory
     */
    public function __construct(
        AuthenticatorInterface $authenticator,
        FactoryInterface $clientFactory
    ) {
        $this->clientFactory = $clientFactory;
        parent::__construct($authenticator);
    }

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
