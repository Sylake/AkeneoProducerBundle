<?php

namespace spec\Sylake\Sylakim\Connector\Step;

use Akeneo\Component\Batch\Job\JobParameters;
use Akeneo\Component\Batch\Model\StepExecution;
use Akeneo\Component\Batch\Step\StepInterface;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Pim\Component\Catalog\Repository\AssociationTypeRepositoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientFactoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientInterface;
use Sylake\Sylakim\Connector\Client\Url;

final class AssociationTypeStepSpec extends ObjectBehavior
{
    function let(
        AssociationTypeRepositoryInterface $associationTypeRepository,
        AssociationTypeClientFactoryInterface $associationTypeClientFactory
    ) {
        $this->beConstructedWith('step name', $associationTypeRepository, $associationTypeClientFactory);
    }

    function it_is_an_akeneo_step()
    {
        $this->shouldImplement(StepInterface::class);
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('step name');
    }

    function it_synchronizes_association_types(
        AssociationTypeRepositoryInterface $associationTypeRepository,
        AssociationTypeClientFactoryInterface $associationTypeClientFactory,
        AssociationTypeClientInterface $associationTypeClient,
        AssociationTypeInterface $firstAssociationType,
        AssociationTypeInterface $secondAssociationType,
        StepExecution $stepExecution
    ) {
        $stepExecution->getJobParameters()->willReturn(new JobParameters([
            'api_url' => 'http://sylius.org',
            'api_public_id' => 'public id',
            'api_secret' => 'secret',
        ]));

        $associationTypeClientFactory
            ->create(Url::fromString('http://sylius.org'), 'public id', 'secret')
            ->willReturn($associationTypeClient)
        ;

        $associationTypeRepository->findAll()->willReturn([
            $firstAssociationType,
            $secondAssociationType,
        ]);

        $associationTypeClient->synchronize($firstAssociationType)->shouldBeCalled();
        $associationTypeClient->synchronize($secondAssociationType)->shouldBeCalled();

        $this->execute($stepExecution);
    }
}
