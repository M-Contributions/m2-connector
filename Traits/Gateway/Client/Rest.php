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
                    $result['response'] = $response->getBody()->getContents();
                    $result['success'] = true;
                    return $result;
                },
                function (RuntimeException $exception) {
                }
            );
            $promise->wait();
        } catch (\Exception $exception) {
            $result['success'] = false;
            $result['message'] = $exception->getMessage();
            $result = json_encode($result);
        }
        return $result;
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
            $result = $this->client->request(
                $verb,
                $endpoint,
                [
                    'headers' => $this->generateHeaders($headers),
                    $this->getFormRequestKey($verb, $headers) => $params
                ]
            )->getBody()->getContents();
        } catch (\Exception $exception) {
            $result['success'] = false;
            $result['message'] = $exception->getMessage();
            $result = json_encode($result);
        }
        return $result;
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
