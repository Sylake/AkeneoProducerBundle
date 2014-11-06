<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylake\Bundle\SylakimBundle\Writer;

use Akeneo\Bundle\BatchBundle\Entity\StepExecution;
use Akeneo\Bundle\BatchBundle\Item\AbstractConfigurableStepElement;
use Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface;
use Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface;
use Sylake\Bundle\SylakimBundle\WebService\ClientInterface;

/**
 * Abstract web service class that defines all configuration requirements for a web service writer
 *
 * @author Romain Monceau <monceau.romain@gmail.com>
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
                    'label' => 'sylake_sylakim.export.host.label',
                    'help'  => 'sylake_sylakim.export.host.help'
                ]
            ],
            'username' => [
                'options' => [
                    'label' => 'sylake_sylakim.export.username.label',
                    'help'  => 'sylake_sylakim.export.username.help'
                ]
            ],
            'apiKey' => [
                'options' => [
                    'label' => 'sylake_sylakim.export.api_key.label',
                    'help'  => 'sylake_sylakim.export.api_key.help'
                ]
            ],
            'httpLogin' => [
                'options' => [
                    'label' => 'sylake_sylakim.export.http_login.label',
                    'help'  => 'sylake_sylakim.export.http_login.help'
                ]
            ],
            'httpPassword' => [
                'options' => [
                    'label' => 'sylake_sylakim.export.http_password.label',
                    'help'  => 'sylake_sylakim.export.http_password.help'
                ]
            ],
            'format' => [
                'options' => [
                    'label' => 'sylake_sylakim.export.format.label',
                    'help'  => 'sylake_sylakim.export.format.help'
                ]
            ]
        ];
    }
}
