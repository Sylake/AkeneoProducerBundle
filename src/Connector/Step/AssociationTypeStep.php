<?php

namespace Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Job\JobRepositoryInterface;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\AbstractStep;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AssociationTypeStep extends AbstractStep
{
    /**
     * @var AssociationTypeRepositoryInterface
     */
    private $associationTypeRepository;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        $name,
        EventDispatcherInterface $eventDispatcher,
        JobRepositoryInterface $jobRepository,
        AssociationTypeRepositoryInterface $associationTypeRepository
    ) {
        parent::__construct($name, $eventDispatcher, $jobRepository);

        $this->associationTypeRepository = $associationTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function doExecute(StepExecution $stepExecution)
    {
        
    }
}
