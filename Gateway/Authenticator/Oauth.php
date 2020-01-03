<?php
declare(strict_types=1);

/**
 * Gateway Class
 * @category    Ticaje
 * @package     Ticaje_Connector
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Connector\Gateway\Authenticator;

use GuzzleHttp\HandlerStack;

use Ticaje\Base\Application\Factory\FactoryInterface;
use Ticaje\Connector\Interfaces\AuthenticatorInterface;

/**
 * Class Oauth
 * @package Ticaje\Connector\Gateway\Authenticator
 * The name of this class should change to a more descriptive one
 */
class Oauth implements AuthenticatorInterface
{
    protected $authType;

    protected $oauthClientFactory;

    protected $oauthClient;

    protected $clientCredentialsFactory;

    protected $credentialsClient;

    protected $oAuth2MiddlewareFactory;

    protected $oauthMiddlewareClient;

    protected $credentials;

    protected $options;

    /**
     * Oauth constructor.
     * @param string $authType
     * @param $oauthClientFactory
     * @param $clientCredentialsFactory
     * @param $oAuth2MiddlewareFactory
     */
    public function __construct(
        string $authType,
        FactoryInterface $oauthClientFactory,
        FactoryInterface $clientCredentialsFactory,
        FactoryInterface $oAuth2MiddlewareFactory
    ) {
        $this->authType = $authType;
        $this->oauthClientFactory = $oauthClientFactory;
        $this->clientCredentialsFactory = $clientCredentialsFactory;
        $this->oAuth2MiddlewareFactory = $oAuth2MiddlewareFactory;
    }

    /**
     * @param array $credentials
     * @return $this
     * As long as no factory approach for this class we are tied to call this method externally with all that it entails.
     */
    public function authenticate(array $credentials)
    {
        $this->credentials = $credentials;
        $this->generateClients();
        $this->generateAuthOptions();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generateClients()
    {
        $this->generateOauthClient();
        $this->generateCredentialsClient();
        $this->generateOauthMiddlewareClient();
    }

    /**
     * @inheritDoc
     * As long as no factory approach for this class we are tied to call this method externally with all that it entails.
     */
    public function generateAuthOptions()
    {
        // Should be commanded by service contract as well
        $stack = $this->setAuthStack();
        $this->options = [
            'handler' => $stack,
            'auth' => $this->authType,
        ];
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function getPermission()
    {
        return $this->generateOauthMiddlewareClient()->getAccessToken();
    }

    /**
     * @return mixed
     * This method creates the class responsible for generating the access token to communicate with the API.
     */
    private function generateOauthClient()
    {
        if (!$this->oauthClient) {
            // By service contract, the class to instantiate receives an argument called config that is an array containing a key called base_uri
            $arguments = [
                'config' => [
                    'base_uri' => $this->credentials['tokenUri']
                ]
            ];
            $this->oauthClient = $this->oauthClientFactory->create($arguments);
        }
        return $this->oauthClient;
    }

    private function generateOauthMiddlewareClient()
    {
        if (!$this->oauthMiddlewareClient) {
            $arguments = ['grantType' => $this->credentialsClient];
            $this->oauthMiddlewareClient = $this->oAuth2MiddlewareFactory->create($arguments);
        }
        return $this->oauthMiddlewareClient;
    }

    private function generateCredentialsClient()
    {
        if (!$this->credentialsClient) {
            $oauthConfig = [
                "client_id" => $this->credentials['consumerKey'],
                "client_secret" => $this->credentials['consumerPassword'],
                "grand_type" => $this->credentials['grand_type'],
            ];
            $arguments = ['client' => $this->oauthClient, 'config' => $oauthConfig];
            $this->credentialsClient = $this->clientCredentialsFactory->create($arguments);
        }
        return $this->credentialsClient;
    }

    /**
     * @return HandlerStack
     */
    private function setAuthStack()
    {
        $stack = HandlerStack::create();
        $stack->push($this->oauthMiddlewareClient);
        return $stack;
    }
}
