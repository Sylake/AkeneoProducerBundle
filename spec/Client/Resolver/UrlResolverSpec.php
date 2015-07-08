<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Resolver;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlResolverSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            'variant' => 'products/{productId}/variants/'
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Resolver\UrlResolver');
    }

    function it_is_a_url_resolver()
    {
        $this->shouldImplement('Sylake\Bundle\SylakimBundle\Client\Resolver\UrlResolverInterface');
    }

    function it_creates_the_url()
    {
        $this->resolve('variant', ['productId' => 1, 'variantId' => 2])->shouldReturn('products/1/variants/');
    }

    function it_creates_the_url_with_a_prefix()
    {
        $this->resolve('variant', ['productId' => 1, 'variantId' => 3, 'id' => 2], true)
            ->shouldReturn('products/1/variants/2');
    }

    function it_throwns_an_exception_when_the_resource_does_not_exist()
    {
        $this->shouldThrow('Sylake\Bundle\SylakimBundle\Client\Exception\UnknownResourceException')->during('resolve', ['product']);
    }
}
