<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Resource;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\Bundle\SylakimBundle\Client\Resource\Item;

class ItemManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Resource\ItemManager');
    }

    function it_finds_item(Item $item)
    {
        $this->register('My\Model\Taxon', $item);

        $this->find('My\Model\Taxon')->shouldReturn($item);
    }

    function it_checks_if_item_exists(Item $item)
    {
        $this->register('My\Model\Taxon', $item);

        $this->has('My\Model\Taxon')->shouldReturn(true);
        $this->has('My\Model\Taxonomy')->shouldReturn(false);
    }

    function it_registers_items(Item $item)
    {
        $this->register('My\Model\Taxon', $item)->shouldReturn($this);
    }
}
