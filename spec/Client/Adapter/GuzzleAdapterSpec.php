<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Adapter;

use Guzzle\Http\ClientInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\Bundle\SylakimBundle\Client\Resolver\UrlResolverInterface;

class GuzzleAdapterSpec extends ObjectBehavior
{
    function let(ClientInterface $client, UrlResolverInterface $urlResolver)
    {
        $this->beConstructedWith($client, $urlResolver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Adapter\GuzzleAdapter');
    }

    function it_is_a_client_adapter()
    {
        $this->shouldImplement('Sylake\Bundle\SylakimBundle\Client\Adapter\ClientAdapterInterface');
    }

    function it_gets_resource($client, $urlResolver)
    {
        $urlResolver->resolve('variant', ['productId' => 1])
            ->shouldBeCalled()
            ->willReturn('products/1/variants');

        $client->get('products/1/variants')->shouldBeCalled();
        $this->get('variant', ['productId' => 1]);
    }

    function it_creates_resource($client, $urlResolver)
    {
        $urlResolver->resolve('variant', ['productId' => 1])
            ->shouldBeCalled()
            ->willReturn('products/1/variants');

        $client->post('products/1/variants', ['productId' => 1])->shouldBeCalled();
        $this->create('variant', ['productId' => 1]);
    }

    function it_updates_resource($client, $urlResolver)
    {
        $urlResolver->resolve('variant', ['productId' => 1, 'variantId' => 2])
            ->shouldBeCalled()
            ->willReturn('products/1/variants/2');

        $client->put('products/1/variants/2', ['productId' => 1, 'variantId' => 2])->shouldBeCalled();
        $this->update('variant', ['productId' => 1, 'variantId' => 2]);
    }

    function it_deletes_resource($client, $urlResolver)
    {
        $urlResolver->resolve('variant', ['productId' => 1, 'variantId' => 2])
            ->shouldBeCalled()
            ->willReturn('products/1/variants/2');

        $client->delete('products/1/variants/2')->shouldBeCalled();

        $this->delete('variant', ['productId' => 1, 'variantId' => 2]);
    }
}
