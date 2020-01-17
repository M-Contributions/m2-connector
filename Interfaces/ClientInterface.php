<?php
declare(strict_types=1);

/**
 * General Interface
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Interfaces;

/**
 * Interface ClientInterface
 * @package Ticaje\Connector\Interfaces
 */
interface ClientInterface
{
    const CONTENT_TYPE_JSON = 'application/json';

    const AUTHORIZATION = 'Authorization';

    const AUTHORIZATION_TYPE_BEARER = 'Bearer';

    const CONTENT_TYPE_FORM_URLENCODED = 'application/x-www-form-urlencoded';

    const CONTENT_TYPE_KEY = 'Content-Type';
}
