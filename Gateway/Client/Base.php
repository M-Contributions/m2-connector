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
use Ticaje\Contract\Patterns\Interfaces\Decorator\ResponderInterface;
use Ticaje\Connector\Interfaces\ClientInterface;

/**
 * Class Base
 * @package Ticaje\Connector\Gateway\Client
 */
abstract class Base implements ClientInterface
{
    protected $client;

    protected $clientFactory;

    protected $responder;

    /**
     * Base constructor.
     * @param ResponderInterface $responder
     * @param FactoryInterface $clientFactory
     */
    public function __construct(
        ResponderInterface $responder,
        FactoryInterface $clientFactory
    ) {
        $this->responder = $responder;
        $this->clientFactory = $clientFactory;
    }
}
