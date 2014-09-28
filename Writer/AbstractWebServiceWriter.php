<?php

namespace Sylius\Bundle\SylakimBundle\Writer;

use Akeneo\Bundle\BatchBundle\Entity\StepExecution;
use Akeneo\Bundle\BatchBundle\Item\AbstractConfigurableStepElement;
use Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface;
use Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface;

/**
 * Abstract web service class that defines all configuration requirements for a web service writer
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
abstract class AbstractWebServiceWriter extends AbstractConfigurableStepElement implements
    ItemWriterInterface,
    StepExecutionAwareInterface
{
    /** @var StepExecution */
    protected $stepExecution;

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

    /** @var string */
    protected $format;

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $httpLogin
     */
    public function setHttpLogin($httpLogin)
    {
        $this->httpLogin = $httpLogin;
    }

    /**
     * @return string
     */
    public function getHttpLogin()
    {
        return $this->httpLogin;
    }

    /**
     * @param string $httpPassword
     */
    public function setHttpPassword($httpPassword)
    {
        $this->httpPassword = $httpPassword;
    }

    /**
     * @return string
     */
    public function getHttpPassword()
    {
        return $this->httpPassword;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * {@inheritdoc}
     */
    public function setStepExecution(StepExecution $stepExecution)
    {
        $this->stepExecution = $stepExecution;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurationFields()
    {
        return [
            'host' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.host.label',
                    'help'  => 'sylius_sylakim.export.host.help'
                ]
            ],
            'username' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.username.label',
                    'help'  => 'sylius_sylakim.export.username.help'
                ]
            ],
            'apiKey' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.api_key.label',
                    'help'  => 'sylius_sylakim.export.api_key.help'
                ]
            ],
            'httpLogin' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.http_login.label',
                    'help'  => 'sylius_sylakim.export.http_login.help'
                ]
            ],
            'httpPassword' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.http_password.label',
                    'help'  => 'sylius_sylakim.export.http_password.help'
                ]
            ],
            'format' => [
                'options' => [
                    'label' => 'sylius_sylakim.export.format.label',
                    'help'  => 'sylius_sylakim.export.format.help'
                ]
            ]
        ];
    }
}
