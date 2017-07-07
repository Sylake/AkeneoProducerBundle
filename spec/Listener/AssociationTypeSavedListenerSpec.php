<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemProjectorInterface;

final class AssociationTypeSavedListenerSpec extends ObjectBehavior
{
    function let(ItemProjectorInterface $associationTypeProjector)
    {
        $this->beConstructedWith($associationTypeProjector);
    }

    function it_ignores_items_not_being_an_association_type(
        ItemProjectorInterface $associationTypeProjector,
        ObjectManager $objectManager
    ) {
        $associationTypeProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this(new LifecycleEventArgs(new \stdClass(), $objectManager->getWrappedObject()));
    }

    function it_projects_item_being_an_association_type(
        ItemProjectorInterface $associationTypeProjector,
        ObjectManager $objectManager,
        AssociationTypeInterface $associationType
    ) {
        $associationTypeProjector->__invoke($associationType)->shouldBeCalled();

        $this(new LifecycleEventArgs($associationType->getWrappedObject(), $objectManager->getWrappedObject()));
    }
}
