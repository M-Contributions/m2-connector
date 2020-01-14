<?php
declare(strict_types=1);

/**
 * Gateway Trait
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Traits\Gateway\Client;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

use Ticaje\Connector\Interfaces\Protocol\RestClientInterface;
use Ticaje\Contract\Patterns\Interfaces\Decorator\ResponderInterface;

/**
 * Trait Rest
 * @package Ticaje\Connector\Traits\Gateway\Client
 * This trait prevents code duplication at the time that fits right with service contracts
 * Uses design-by-contract pattern in order to guarantee business rules
 */
trait Rest
{
    /**
     * @param $verb
     * @param $endpoint
     * @param array $headers
     * @param array $params
     * @return array
     */
    public function requestAsync($verb, $endpoint, array $headers = [], array $params)
    {
        $result = [];
        try {
            $promise = $this->client->requestAsync(
                $verb,
                $endpoint,
                [
                    'headers' => $this->generateHeaders($headers),
                    $this->getFormRequestKey($verb, $headers) => $params
                ]
            );
            $promise->then(
                function (ResponseInterface $response) use (&$result) {
                    $result[ResponderInterface::CONTENT_KEY] = $response->getBody()->getContents();
                    $result[ResponderInterface::SUCCESS_KEY] = true;
                    $result[ResponderInterface::MESSAGE_KEY] = 'Response correctly received'; // Perhaps normalize this message
                    return $result;
                },
                function (RuntimeException $exception) {
                    // Missing implementation
                }
            );
            $promise->wait();
        } catch (\Exception $exception) {
            $result[ResponderInterface::CONTENT_KEY] = null;
            $result[ResponderInterface::SUCCESS_KEY] = false;
            $result[ResponderInterface::MESSAGE_KEY] = $exception->getMessage();
        }
        return $this->responder->process($result);
    }

    /**
     * @param $verb
     * @param $endpoint
     * @param array $headers
     * @param array $params
     * @return array
     */
    public function request($verb, $endpoint, array $headers = [], array $params = [])
    {
        $result = [];
        try {
            $result[ResponderInterface::CONTENT_KEY] = $this->client->request(
                $verb,
                $endpoint,
                [
                    'headers' => $this->generateHeaders($headers),
                    $this->getFormRequestKey($verb, $headers) => $params
                ]
            )->getBody()->getContents();
            $result[ResponderInterface::SUCCESS_KEY] = true;
            $result[ResponderInterface::MESSAGE_KEY] = 'Response correctly received'; // Perhaps normalize this message
        } catch (\Exception $exception) {
            $result[ResponderInterface::CONTENT_KEY] = null;
            $result[ResponderInterface::SUCCESS_KEY] = false;
            $result[ResponderInterface::MESSAGE_KEY] = $exception->getMessage();
        }
        return $this->responder->process($result);
    }

    /**
     * @param $verb
     * @param $headers
     * @return string
     */
    private function getFormRequestKey($verb, $headers)
    {
        // The values should also be constantized
        $key = $verb ? 'query' : 'form_params';
        $key = $headers[RestClientInterfac::CONTENT_TYPE_KEY] == RestClientInterface::CONTENT_TYPE_JSON ? 'json' : $key;
        return $key;
    }
}
