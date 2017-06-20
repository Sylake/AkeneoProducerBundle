<?php

namespace Sylake\AkeneoProducerBundle\Connector\JobParameters;

use Akeneo\Component\Batch\Job\JobInterface;
use Akeneo\Component\Batch\Job\JobParameters\ConstraintCollectionProviderInterface;
use Akeneo\Component\Batch\Job\JobParameters\DefaultValuesProviderInterface;

final class AkeneoProducer implements ConstraintCollectionProviderInterface, DefaultValuesProviderInterface
{
    /**
     * @var DefaultValuesProviderInterface
     */
    private $baseDefaultValuesProvider;

    /**
     * @var ConstraintCollectionProviderInterface
     */
    private $baseConstraintCollectionProvider;

    /**
     * @var string[]
     */
    private $supportedJobNames;

    /**
     * @param DefaultValuesProviderInterface $baseDefaultValuesProvider
     * @param ConstraintCollectionProviderInterface $baseConstraintCollectionProvider
     * @param string[] $supportedJobNames
     */
    public function __construct(
        DefaultValuesProviderInterface $baseDefaultValuesProvider,
        ConstraintCollectionProviderInterface $baseConstraintCollectionProvider,
        array $supportedJobNames
    ) {
        $this->baseDefaultValuesProvider = $baseDefaultValuesProvider;
        $this->baseConstraintCollectionProvider = $baseConstraintCollectionProvider;
        $this->supportedJobNames = $supportedJobNames;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultValues()
    {
        $defaultValues = $this->baseDefaultValuesProvider->getDefaultValues();

        $defaultValues['filters'] = [
            'data' => ['field' => 'enabled', 'operator' => '=', 'value' => true],
            'structure' => [],
        ];

        return $defaultValues;
    }

    /**
     * {@inheritdoc}
     */
    public function getConstraintCollection()
    {
        return $this->baseConstraintCollectionProvider->getConstraintCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function supports(JobInterface $job)
    {
        return in_array($job->getName(), $this->supportedJobNames, true);
    }
}
