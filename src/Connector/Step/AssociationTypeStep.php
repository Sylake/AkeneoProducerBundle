<?php

namespace Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\StepInterface;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientFactoryInterface;
use Sylake\Sylakim\Connector\Client\ResourceClientInterface;
use Sylake\Sylakim\Connector\Client\Url;
use Sylake\Sylakim\Connector\Synchronizer\AssociationTypeSynchronizerInterface;

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
     * @var AssociationTypeSynchronizerInterface
     */
    private $associationTypeSynchronizer;

    /**
     * @param string $name
     * @param AssociationTypeRepositoryInterface $associationTypeRepository
     * @param AssociationTypeClientFactoryInterface $associationTypeClientFactory
     * @param AssociationTypeSynchronizerInterface $associationTypeSynchronizer
     */
    public function __construct(
        $name,
        AssociationTypeRepositoryInterface $associationTypeRepository,
        AssociationTypeClientFactoryInterface $associationTypeClientFactory,
        AssociationTypeSynchronizerInterface $associationTypeSynchronizer
    ) {
        $this->name = $name;
        $this->associationTypeRepository = $associationTypeRepository;
        $this->associationTypeClientFactory = $associationTypeClientFactory;
        $this->associationTypeSynchronizer = $associationTypeSynchronizer;
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
            $this->associationTypeSynchronizer->synchronize($associationTypeClient, $associationType);
        }
    }

    /**
     * @param StepExecution $stepExecution
     *
     * @return ResourceClientInterface
     */
    private function getClient(StepExecution $stepExecution)
    {
        $jobParameters = $stepExecution->getJobParameters()->all();
        $associationTypeClient = $this->associationTypeClientFactory->create(
            Url::fromString($jobParameters['api_url']),
            $jobParameters['api_public_id'],
            $jobParameters['api_secret'],
            $jobParameters['admin_login'],
            $jobParameters['admin_password']
        );

        return $associationTypeClient;
    }
}
