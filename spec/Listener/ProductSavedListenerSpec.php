<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\ProductInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemSetInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ProductSavedListenerSpec extends ObjectBehavior
{
    function let(ItemSetInterface $itemSet)
    {
        $this->beConstructedWith($itemSet);
    }

    function it_ignores_items_not_being_a_product(ItemSetInterface $itemSet)
    {
        $itemSet->add(Argument::any())->shouldNotBeCalled();

        $this(new GenericEvent(new \stdClass()));
    }

    function it_adds_item_being_a_product_to_item_set(ItemSetInterface $itemSet, ProductInterface $product)
    {
        $itemSet->add($product)->shouldBeCalled();

        $this(new GenericEvent($product->getWrappedObject()));
    }
}
