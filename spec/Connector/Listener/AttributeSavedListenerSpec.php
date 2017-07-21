<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector\Listener;

use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Model\AttributeOptionInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class AttributeSavedListenerSpec extends ObjectBehavior
{
    function let(ItemSetInterface $itemSet)
    {
        $this->beConstructedWith($itemSet);
    }

    function it_ignores_items_not_being_a_attribute(ItemSetInterface $itemSet)
    {
        $itemSet->add(Argument::any())->shouldNotBeCalled();

        $this(new GenericEvent(new \stdClass()));
    }

    function it_adds_item_being_a_attribute_to_item_set(
        ItemSetInterface $itemSet,
        AttributeInterface $attribute
    ) {
        $attribute->getOptions()->willReturn([]);

        $itemSet->add($attribute)->shouldBeCalled();

        $this(new GenericEvent($attribute->getWrappedObject()));
    }

    function it_adds_item_being_a_attribute_and_its_options_to_item_set(
        ItemSetInterface $itemSet,
        AttributeInterface $attribute,
        AttributeOptionInterface $attributeOption
    ) {
        $attribute->getOptions()->willReturn([$attributeOption]);

        $itemSet->add($attribute)->shouldBeCalled();
        $itemSet->add($attributeOption)->shouldBeCalled();

        $this(new GenericEvent($attribute->getWrappedObject()));
    }
}
