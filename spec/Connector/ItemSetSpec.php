<?php

namespace spec\Sylake\AkeneoProducerBundle\Connector;

use PhpSpec\ObjectBehavior;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class ItemSetSpec extends ObjectBehavior
{
    function it_is_an_item_set()
    {
        $this->shouldImplement(ItemSetInterface::class);
    }

    public function it_stores_unique_items()
    {
        $firstItem = new \stdClass();
        $secondItem = new \stdClass();

        $this->add($firstItem);
        $this->add($secondItem);

        $this->all()->shouldReturn([$firstItem, $secondItem]);

        $this->add($firstItem);

        $this->all()->shouldReturn([$firstItem, $secondItem]);

        $this->clear();

        $this->all()->shouldReturn([]);

        $this->add($firstItem);

        $this->all()->shouldReturn([$firstItem]);
    }

    public function it_does_not_allow_to_store_scalars()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', ['scalar']);
    }
}
