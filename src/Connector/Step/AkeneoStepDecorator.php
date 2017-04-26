<?php

namespace Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Job\JobRepositoryInterface;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\AbstractStep;
use Akeneo\Component\Batch\Step\StepInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AkeneoStepDecorator extends AbstractStep
{
    /**
     * @var StepInterface
     */
    private $decoratedStep;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        StepInterface $decoratedStep,
        EventDispatcherInterface $eventDispatcher,
        JobRepositoryInterface $jobRepository
    ) {
        parent::__construct($decoratedStep->getName(), $eventDispatcher, $jobRepository);

        $this->decoratedStep = $decoratedStep;
    }

    /**
     * {@inheritdoc}
     */
    protected function doExecute(StepExecution $stepExecution)
    {
        $this->decoratedStep->execute($stepExecution);
    }
}
