<?php

namespace Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\StepInterface;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientFactoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientInterface;
use Sylake\Sylakim\Connector\Client\Url;

final class AssociationTypeStep implements StepInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var AssociationTypeRepositoryInterface
     */
    private $associationTypeRepository;

    /**
     * @var AssociationTypeClientFactoryInterface
     */
    private $associationTypeClientFactory;

    /**
     * @param string $name
     * @param AssociationTypeRepositoryInterface $associationTypeRepository
     * @param AssociationTypeClientFactoryInterface $associationTypeClientFactory
     */
    public function __construct(
        $name,
        AssociationTypeRepositoryInterface $associationTypeRepository,
        AssociationTypeClientFactoryInterface $associationTypeClientFactory
    ) {
        $this->name = $name;
        $this->associationTypeRepository = $associationTypeRepository;
        $this->associationTypeClientFactory = $associationTypeClientFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(StepExecution $stepExecution)
    {
        $associationTypeClient = $this->getClient($stepExecution);

        $associationTypes = $this->associationTypeRepository->findAll();
        foreach ($associationTypes as $associationType) {
            $associationTypeClient->synchronize($associationType);
        }
    }

    /**
     * @param StepExecution $stepExecution
     *
     * @return AssociationTypeClientInterface
     */
    private function getClient(StepExecution $stepExecution)
    {
        $jobParameters = $stepExecution->getJobParameters();
        $associationTypeClient = $this->associationTypeClientFactory->create(
            Url::fromString($jobParameters['url']),
            $jobParameters['public_id'],
            $jobParameters['secret']
        );

        return $associationTypeClient;
    }
}
