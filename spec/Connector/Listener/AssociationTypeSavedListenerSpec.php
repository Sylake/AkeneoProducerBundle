<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class AssociationTypeSavedListenerSpec extends ObjectBehavior
{
    function let(ItemSetInterface $itemSet)
    {
        $this->beConstructedWith($itemSet);
    }

    function it_ignores_items_not_being_an_association_type(
        ItemSetInterface $itemSet,
        ObjectManager $objectManager
    ) {
        $itemSet->add(Argument::any())->shouldNotBeCalled();

        $this(new LifecycleEventArgs(new \stdClass(), $objectManager->getWrappedObject()));
    }

    function it_adds_item_being_an_association_type_to_item_set(
        ItemSetInterface $itemSet,
        ObjectManager $objectManager,
        AssociationTypeInterface $associationType
    ) {
        $itemSet->add($associationType)->shouldBeCalled();

        $this(new LifecycleEventArgs($associationType->getWrappedObject(), $objectManager->getWrappedObject()));
    }
}
