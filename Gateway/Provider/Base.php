<?php
declare(strict_types=1);

/**
 * Gateway Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Provider;

use Ticaje\Connector\Interfaces\ClientInterface;

/**
 * Class Base
 * @package Ticaje\Connector\Gateway\Provider
 */
abstract class Base
{
    protected $connector;

    protected $params;

    /**
     * Base constructor.
     * @param ClientInterface $connector
     */
    public function __construct(
        ClientInterface $connector
    ) {
        $this->connector = $connector;
    }

    public function initialize($credentials)
    {
        $this->connector->generateClient($credentials);
        return $this;
    }
}
