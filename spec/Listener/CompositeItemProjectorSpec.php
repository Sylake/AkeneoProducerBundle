<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemProjectorInterface;

final class CompositeItemProjectorSpec extends ObjectBehavior
{
    function let(ItemProjectorInterface $traversableItemProjector)
    {
        $this->beConstructedWith([
            \Traversable::class => $traversableItemProjector,
        ]);
    }

    function it_is_an_item_projector()
    {
        $this->shouldImplement(ItemProjectorInterface::class);
    }

    function it_throws_an_exception_if_unable_to_project_passed_item(ItemProjectorInterface $traversableItemProjector)
    {
        $traversableItemProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this->shouldThrow(\DomainException::class)->during('__invoke', [new \stdClass()]);
    }

    function it_projects_the_item_if_projector_is_found(ItemProjectorInterface $traversableItemProjector, \Iterator $item)
    {
        $traversableItemProjector->__invoke($item)->shouldBeCalled();

        $this($item);
    }
}
