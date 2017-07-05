<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use PhpSpec\ObjectBehavior;
use Pim\Component\Catalog\Model\ProductInterface;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemProjectorInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ProductSavedListenerSpec extends ObjectBehavior
{
    function let(ItemProjectorInterface $productProjector)
    {
        $this->beConstructedWith($productProjector);
    }

    function it_ignores_items_not_being_a_product(ItemProjectorInterface $productProjector)
    {
        $productProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this(new GenericEvent(new \stdClass()));
    }

    function it_projects_item_being_a_product(ItemProjectorInterface $productProjector, ProductInterface $product)
    {
        $productProjector->__invoke($product)->shouldBeCalled();

        $this(new GenericEvent($product->getWrappedObject()));
    }
}
