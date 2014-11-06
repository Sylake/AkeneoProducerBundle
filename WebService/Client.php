<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylake\Bundle\SylakimBundle\WebService;

/**
 * Client used to call the Sylius API
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
class Client implements ClientInterface
{
    /** @var string */
    protected $host;

    /** @var string */
    protected $username;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $httpLogin;

    /** @var string */
    protected $httpPassword;

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpLogin($httpLogin)
    {
        $this->httpLogin = $httpLogin;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpLogin()
    {
        return $this->httpLogin;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpPassword($httpPassword)
    {
        $this->httpPassword = $httpPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpPassword()
    {
        return $this->httpPassword;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
}
