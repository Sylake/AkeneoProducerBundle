<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client;

use Guzzle\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\Bundle\SylakimBundle\Client\Resource\ItemManager;
use Sylake\Bundle\SylakimBundle\Client\Transformer\ObjectToArrayTransformer;

class ApiObjectManagerSpec extends ObjectBehavior
{
    function let(Client $client, ItemManager $itemManager, ObjectToArrayTransformer $transformer)
    {
        $this->beConstructedWith($client, $itemManager, $transformer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\ApiObjectManager');
    }

    function it_creates_resource()
    {
        $this->create();
    }

    function it_updates_resource()
    {
        $this->update();
    }

    function it_deletes_resource()
    {
        $this->delete();
    }

    function it_saves_resource()
    {
        $this->save();
    }
}
