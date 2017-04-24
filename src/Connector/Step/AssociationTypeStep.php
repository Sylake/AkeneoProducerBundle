<?php

namespace Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Job\JobRepositoryInterface;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\AbstractStep;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AssociationTypeStep extends AbstractStep
{
    /**
     * @var AssociationTypeRepositoryInterface
     */
    private $associationTypeRepository;

    /**
     * @var AssociationTypeClientFactoryInterface
     */
    private $associationTypeClientFactory;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        $name,
        EventDispatcherInterface $eventDispatcher,
        JobRepositoryInterface $jobRepository,
        AssociationTypeRepositoryInterface $associationTypeRepository,
        AssociationTypeClientFactoryInterface $associationTypeClientFactory
    ) {
        parent::__construct($name, $eventDispatcher, $jobRepository);

        $this->associationTypeRepository = $associationTypeRepository;
        $this->associationTypeClientFactory = $associationTypeClientFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function doExecute(StepExecution $stepExecution)
    {
        $jobParameters = $stepExecution->getJobParameters();
        $associationTypeClient = $this->associationTypeClientFactory->create(
            $jobParameters['url'],
            $jobParameters['public_id'],
            $jobParameters['secret']
        );

        $associationTypes = $this->associationTypeRepository->findAll();
        foreach ($associationTypes as $associationType) {
            if ($associationTypeClient->exists($associationType)) {
                $associationTypeClient->update($associationType);

                return;
            }

            $associationTypeClient->create($associationType);
        }

    }
}
