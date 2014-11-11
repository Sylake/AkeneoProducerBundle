<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Transformer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ObjectToArrayTransformerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Transformer\ObjectToArrayTransformer');
    }

    function it_trnasforms_an_object_to_an_array()
    {
        $this->transformer();
    }

    function it_trnasforms_an_array_to_an_object()
    {
        $this->reverseTransform();
    }
}
