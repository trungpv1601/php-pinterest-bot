<?php

namespace seregazhuk\PinterestBot;

use LogicException;
use seregazhuk\PinterestBot\Api\Providers\Pins;
use seregazhuk\PinterestBot\Api\Providers\Boards;
use seregazhuk\PinterestBot\Api\Providers\Pinners;
use seregazhuk\PinterestBot\Api\Providers\Provider;
use seregazhuk\PinterestBot\Api\Providers\Interests;
use seregazhuk\PinterestBot\Api\Providers\Conversations;
use seregazhuk\PinterestBot\Contracts\ProvidersContainerInterface;

/**
 * Class Bot
 *
 * @package Pinterest
 * @property Pinners       $pinners
 * @property Pins          $pins
 * @property Boards        $boards
 * @property Interests     $interests
 * @property Conversations $conversations
 */
class Bot
{
    /**
     * @var ProvidersContainerInterface
     */
    private $providersContainer;

    public function __construct(ProvidersContainerInterface $providersContainer)
    {
        $this->providersContainer = $providersContainer;
    }

    /**
     * Proxy method to pinners login
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        return $this->pinners->login($username, $password);
    }

    /**
     * @param string $provider
     * @return Provider
     */
    public function __get($provider)
    {
        return $this->providersContainer->getProvider($provider);
    }

    /**
     * @return array
     */
    public function getLastError()
    {
        return $this->providersContainer->getResponse()->getLastError();
    }
}