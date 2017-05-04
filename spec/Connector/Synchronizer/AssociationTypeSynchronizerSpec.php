<?php

namespace spec\Sylake\Sylakim\Connector\Synchronizer;

use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Entity\AssociationType;
use Pim\Bundle\CatalogBundle\Entity\AssociationTypeTranslation;
use Prophecy\Argument;
use Sylake\Sylakim\Connector\Client\ResourceClientInterface;
use Sylake\Sylakim\Connector\Synchronizer\AssociationTypeSynchronizerInterface;

final class AssociationTypeSynchronizerSpec extends ObjectBehavior
{
    function it_is_an_association_type_synchronizer()
    {
        $this->shouldImplement(AssociationTypeSynchronizerInterface::class);
    }

    function it_creates_a_new_association_type_if_not_exists(ResourceClientInterface $resourceClient)
    {
        $associationType = new AssociationType();
        $associationType->setCode('FOO');

        $associationTypeTranslation = new AssociationTypeTranslation();
        $associationTypeTranslation->setLocale('en');
        $associationTypeTranslation->setLabel('Foo');

        $associationType->addTranslation($associationTypeTranslation);

        $resourceClient->exists('FOO')->willReturn(false);

        $resourceClient->create([
            'code' => 'FOO',
            'translations' => [
                'en' => [
                    'name' => 'Foo',
                ],
            ],
        ])->shouldBeCalled();
        $resourceClient->update(Argument::any(), Argument::any())->shouldNotBeCalled();

        $this->synchronize($resourceClient, $associationType);
    }

    function it_updates_the_association_type_if_it_already_exists(ResourceClientInterface $resourceClient)
    {
        $associationType = new AssociationType();
        $associationType->setCode('FOO');

        $associationTypeTranslation = new AssociationTypeTranslation();
        $associationTypeTranslation->setLocale('en');
        $associationTypeTranslation->setLabel('Foo');

        $associationType->addTranslation($associationTypeTranslation);

        $resourceClient->exists('FOO')->willReturn(true);

        $resourceClient->update('FOO', [
            'translations' => [
                'en' => [
                    'name' => 'Foo',
                ],
            ],
        ])->shouldBeCalled();
        $resourceClient->create(Argument::any())->shouldNotBeCalled();

        $this->synchronize($resourceClient, $associationType);
    }
}
