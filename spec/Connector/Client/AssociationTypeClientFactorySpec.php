<?php

namespace spec\Sylake\Sylakim\Connector\Client;

use PhpSpec\ObjectBehavior;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientFactoryInterface;
use Sylake\Sylakim\Connector\Client\AssociationTypeClientInterface;
use Sylake\Sylakim\Connector\Client\Url;

final class AssociationTypeClientFactorySpec extends ObjectBehavior
{
    function it_is_an_association_type_client_factory()
    {
        $this->shouldImplement(AssociationTypeClientFactoryInterface::class);
    }

    function it_creates_an_association_type_client_from_given_credentials()
    {
        $this
            ->create(Url::fromString('http://sylius.local'), 'public id', 'secret')
            ->shouldBeAnInstanceOf(AssociationTypeClientInterface::class)
        ;
    }
}
