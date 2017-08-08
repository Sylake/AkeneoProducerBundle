<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\FamilyInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class FamilySavedListenerSpec extends ObjectBehavior
{
    function let(ItemSetInterface $itemSet)
    {
        $this->beConstructedWith($itemSet);
    }

    function it_ignores_items_not_being_a_category(
        ItemSetInterface $itemSet,
        ObjectManager $objectManager
    ) {
        $itemSet->add(Argument::any())->shouldNotBeCalled();

        $this(new LifecycleEventArgs(new \stdClass(), $objectManager->getWrappedObject()));
    }

    function it_adds_item_being_a_category_to_item_set(
        ItemSetInterface $itemSet,
        ObjectManager $objectManager,
        FamilyInterface $category
    ) {
        $itemSet->add($category)->shouldBeCalled();

        $this(new LifecycleEventArgs($category->getWrappedObject(), $objectManager->getWrappedObject()));
    }
}
