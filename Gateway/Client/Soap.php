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
use Ticaje\Connector\Interfaces\Protocol\SoapClientInterface;
use Ticaje\Connector\Interfaces\Provider\Authentication\AuthenticatorInterface;
use Ticaje\Contract\Patterns\Interfaces\Decorator\ResponderInterface;

/**
 * Class Soap
 * @package Ticaje\Connector\Gateway\Client
 */
class Soap extends Base implements SoapClientInterface
{
    protected $authenticator;

    /**
     * Soap constructor.
     * @param ResponderInterface $responder
     * @param FactoryInterface $clientFactory
     * @param AuthenticatorInterface $authenticator
     * Pending the Virtual Type on DC definition to create recipe for dependencies of this module
     * In a temporary basis we're gonna leave the implementation for this driver empty since it's not likely that we end up using it
     */
    public function __construct(
        ResponderInterface $responder,
        FactoryInterface $clientFactory,
        AuthenticatorInterface $authenticator
    ) {
        $this->authenticator = $authenticator;
        parent::__construct($responder, $clientFactory);
    }

    /**
     * @inheritDoc
     */
    public function generateClient($credentials)
    {
        $config = ['options' => $this->authenticator->authenticate($credentials), 'wsdl' => $credentials['wsdl']];
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
