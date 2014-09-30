<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylakim
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\SylakimBundle\Writer;

use Akeneo\Bundle\BatchBundle\Entity\StepExecution;
use Akeneo\Bundle\BatchBundle\Item\AbstractConfigurableStepElement;
use Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface;
use Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface;
use Sylius\Bundle\SylakimBundle\WebService\ClientInterface;

/**
 * Abstract web service class that defines all configuration requirements for a web service writer
 *
 * @author Romain Monceau <romain@akeneo.com>
 */
abstract class AbstractWriter extends AbstractConfigurableStepElement implements
    ItemWriterInterface,
    StepExecutionAwareInterface
{
    /** @var StepExecution */
    protected $stepExecution;

    /** @var string */
    protected $format;

    /** @var ClientInterface */
    protected $client;

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
