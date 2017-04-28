<?php

namespace spec\Sylake\Sylakim\Connector\Client;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Api\ApiInterface;

final class ResourceClientSpec extends ObjectBehavior
{
    function let(ApiInterface $api)
    {
        $this->beConstructedWith($api);
    }

    function it_assumes_resource_does_not_exists_if_response_follows_specific_format(ApiInterface $api)
    {
        $api->get('foo')->willReturn(['code' => 404, 'message' => 'wololo']);

        $this->exists('foo')->shouldReturn(false);
    }

    function it_delegates_creating_a_resource_to_underlying_api(ApiInterface $api)
    {
        $api->create(['foo' => 'bar'])->shouldBeCalled();

        $this->create(['foo' => 'bar']);
    }

    function it_delegates_updating_the_resource_to_underlying_api(ApiInterface $api)
    {
        $api->update('lol', ['foo' => 'bar'])->shouldBeCalled();

        $this->update('lol', ['foo' => 'bar']);
    }
}
