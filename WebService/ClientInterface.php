<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylakim
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\SylakimBundle\WebService;

/**
 * Client interface used to call the Sylius API
 *
 * @author Julien Janvier <j.janvier@gmail.com>
 */
interface ClientInterface
{
    /**
     * @param string $apiKey
     *
     * @return ClientInterface
     */
    public function setApiKey($apiKey);
    /**
     * @return string
     */
    public function getApiKey();

    /**
     * @param string $httpLogin
     *
     * @return ClientInterface
     */
    public function setHttpLogin($httpLogin);

    /**
     * @return string
     */
    public function getHttpLogin();

    /**
     * @param string $httpPassword
     *
     * @return ClientInterface
     */
    public function setHttpPassword($httpPassword);

    /**
     * @return string
     */
    public function getHttpPassword();

    /**
     * @param string $username
     *
     * @return ClientInterface
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $host
     *
     * @return ClientInterface
     */
    public function setHost($host);

    /**
     * @return string
     */
    public function getHost();
} 
