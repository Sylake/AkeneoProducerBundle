<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownResourceExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('variant');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Exception\UnknownResourceException');
    }

    function it_is_a_exception()
    {
        $this->shouldHaveType('\Exception');
    }

    function it_has_message()
    {
        $this->getMessage()->shouldReturn('The resource "variant" is not configured in the url resolver');
    }
}
