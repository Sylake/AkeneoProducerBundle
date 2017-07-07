<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\AttributeInterface;
use Pim\Component\Catalog\Model\AttributeOptionInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemProjectorInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class AttributeSavedListenerSpec extends ObjectBehavior
{
    function let(ItemProjectorInterface $attributeProjector, ItemProjectorInterface $attributeOptionProjector)
    {
        $this->beConstructedWith($attributeProjector, $attributeOptionProjector);
    }

    function it_ignores_items_not_being_a_attribute(
        ItemProjectorInterface $attributeProjector,
        ItemProjectorInterface $attributeOptionProjector
    ) {
        $attributeProjector->__invoke(Argument::any())->shouldNotBeCalled();
        $attributeOptionProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this(new GenericEvent(new \stdClass()));
    }

    function it_projects_item_being_a_attribute(
        ItemProjectorInterface $attributeProjector,
        ItemProjectorInterface $attributeOptionProjector,
        AttributeInterface $attribute
    ) {
        $attribute->getOptions()->willReturn([]);

        $attributeProjector->__invoke($attribute)->shouldBeCalled();
        $attributeOptionProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this(new GenericEvent($attribute->getWrappedObject()));
    }

    function it_projects_item_being_a_attribute_and_its_options(
        ItemProjectorInterface $attributeProjector,
        ItemProjectorInterface $attributeOptionProjector,
        AttributeInterface $attribute,
        AttributeOptionInterface $attributeOption
    ) {
        $attribute->getOptions()->willReturn([$attributeOption]);

        $attributeProjector->__invoke($attribute)->shouldBeCalled();
        $attributeOptionProjector->__invoke($attributeOption)->shouldBeCalled();

        $this(new GenericEvent($attribute->getWrappedObject()));
    }
}
