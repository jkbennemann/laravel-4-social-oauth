<?php
/**
 * @author     Dariusz Prząda <artdarek@gmail.com>
 * @copyright  Copyright (c) 2013
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */

namespace Jkbennemann\OAuth;

use Illuminate\Support\Facades\Config;

use Jkbennemann\Auth\Service;
use Jkbennemann\Common\HttpStack;
use SocialConnect\HttpClient\Curl;
use SocialConnect\HttpClient\RequestFactory;
use SocialConnect\HttpClient\StreamFactory;
use Jkbennemann\Provider\AbstractBaseProvider;
use Jkbennemann\Provider\Session\Session;
use \URL;

class OAuth
{
    /**
     * @var Service
     */
    private $_serviceFactory;

    /**
     * Storage name from config
     * @var string
     */
    private $_storage_name = 'Session';

    /**
     * Client ID from config
     * @var string
     */
    private $_client_id;

    /**
     * Client secret from config
     * @var string
     */
    private $_client_secret;

    /**
     * Scope from config
     * @var array
     */
    private $_scope = array();

    /**
     * Constructor
     *
     * @param Service $serviceFactory - (Dependency injection) If not provided, a ServiceFactory instance will be constructed.
     */
    public function __construct(Service $serviceFactory = null)
    {
        if (null === $serviceFactory) {
            // Create the service factory
            $httpClient = new Curl();

            $httpStack = new HttpStack(
                $httpClient,
                new RequestFactory(),
                new StreamFactory()
            );
            $serviceFactory = new Service(
                $httpStack,
                new Session(),
                Config::get('laravel-4-social-oauth')
            );
        }
        $this->_serviceFactory = $serviceFactory;
    }

    /**
     * Detect config and set data from it
     *
     * @param string $service
     */
    public function setConfig( $service )
    {
    }

    /**
     * Create storage instance
     *
     * @param string $storageName
     * @return void
     */
    public function createStorageInstance($storageName)
    {
    }

    /**
     * Set the http client object
     *
     * @param string $httpClientName
     * @return void
     */
    public function setHttpClient($httpClientName)
    {
    }

    /**
     * @param  string $service
     * @param  string $url
     * @param  array  $scope
     * @return AbstractBaseProvider
     */
    public function provider( $service, $url = null, $scope = null )
    {
        //TODO set config dynamically
        $this->setConfig( strtolower($service) );

        //TODO check if scopes were provided
        if (is_null($scope))
        {
            // get scope from config (default to empty array)
            $scope = $this->_scope;
        }

        // return the service consumer object
        return $this->_serviceFactory->getProvider(strtolower($service));
    }
}
