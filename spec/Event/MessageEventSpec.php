<?php

namespace spec\Sylake\AkeneoProducerBundle\Event;

use PhpSpec\ObjectBehavior;

class MessageEventSpec extends ObjectBehavior
{
    function it_should_be_constructed_correctly()
    {
        $payload = [
            'foo' => 'bar'
        ];

        $type = 'type';

        $this->beConstructedWith($type, $payload);

        $this->getType()->shouldReturn($type);
        $this->getPayload()->shouldReturn($payload);
    }
}
