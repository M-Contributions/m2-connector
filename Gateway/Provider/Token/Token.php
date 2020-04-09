<?php
declare(strict_types=1);

/**
 * Gateway Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Provider\Token;

use Ticaje\Connector\Gateway\Provider\Base;
use Ticaje\Connector\Interfaces\ClientInterface;
use Ticaje\Connector\Interfaces\Provider\Token\TokenProviderInterface;
use Ticaje\Contract\Patterns\Interfaces\Decorator\Responder\ResponseInterface;

/**
 * Class Token
 * @package Ticaje\Connector\Gateway\Provider\Token
 */
class Token extends Base implements TokenProviderInterface
{
    protected $accessToken;

    protected $verb;

    protected $endpoint;

    protected $baseUri;

    /**
     * Token constructor.
     * @param ClientInterface $connector
     * @param string $endpoint
     * @param string $verb
     * @param string $baseUri
     */
    public function __construct(
        ClientInterface $connector,
        string $endpoint,
        string $verb,
        string $baseUri
    ) {
        $this->verb = $verb;
        $this->endpoint = $endpoint;
        $this->baseUri = $baseUri;
        parent::__construct($connector);
        $this->initialize([ClientInterface::BASE_URI_KEY => $this->baseUri]);
    }

    /**
     * @inheritDoc
     */
    public function getAccessToken()
    {
        if (!$this->accessToken) {
            $headers = [
                ClientInterface::CONTENT_TYPE_KEY => ClientInterface::CONTENT_TYPE_FORM_URLENCODED,
                'Accept' => ClientInterface::CONTENT_TYPE_JSON,
            ];
            $params = $this->params;
            $endPoint = $this->endpoint;
            /** @var ResponseInterface $response */
            $response = $this->connector->request($this->verb, $endPoint, $headers, $params);
            $this->accessToken = $response->content;
        }
        return $this->accessToken;
    }

    /**
     * @inheritDoc
     * Perhaps using composition on this might be a cleaner way
     */
    public function setParams(array $params): TokenProviderInterface
    {
        $this->params = $params;
        return $this;
    }
}
