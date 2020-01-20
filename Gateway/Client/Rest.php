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
use Ticaje\Connector\Interfaces\Protocol\RestClientInterface;
use Ticaje\Connector\Traits\Gateway\Client\Rest as RestTrait;
use Ticaje\Contract\Patterns\Interfaces\Decorator\ResponderInterface;

/**
 * Class Rest
 * @package Ticaje\Connector\Gateway\Client
 */
class Rest extends Base implements RestClientInterface
{
    use RestTrait;

    protected $accessToken;

    protected $baseUriKey;

    /**
     * Rest constructor.
     * @param ResponderInterface $responder
     * @param FactoryInterface $clientFactory
     * @param string $baseUriKey
     */
    public function __construct(
        ResponderInterface $responder,
        FactoryInterface $clientFactory,
        string $baseUriKey
    ) {
        $this->baseUriKey = $baseUriKey;
        parent::__construct($responder, $clientFactory);
    }

    /**
     * @inheritDoc
     */
    public function generateClient($credentials)
    {
        // If auth problems the log and return void
        $this->client = $this->clientFactory->create([
            'config' => [ // Playing a little bit with Magento rules by passing config key, must ve refactored
                $this->baseUriKey => $credentials[self::BASE_URI_KEY]
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
