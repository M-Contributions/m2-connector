<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces\Protocol;

use Ticaje\Connector\Interfaces\ClientInterface;
use Ticaje\Connector\Interfaces\CredentialInterface;

/**
 * Interface FtpClientInterface
 * @package Ticaje\Connector\Interfaces\Protocol
 */
interface FtpClientInterface extends ClientInterface
{
    /**
     * @return bool
     */
    public function isConnected(): bool;

    /**
     * @param CredentialInterface $credentials
     * @return mixed
     */
    public function connect(CredentialInterface $credentials);

    /**
     * @param $path
     * @return mixed
     */
    public function get($path = '');

    /**
     * @param string $dir
     * @return mixed
     */
    public function ls($dir = '.'): array;

    /**
     * @param string $path
     * @param string $destination
     * @return mixed
     */
    public function download($path = '', $destination);
}
