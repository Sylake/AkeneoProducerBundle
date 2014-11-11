<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client\Resource;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('api/taxonmies/', 'My/Custom/QueryRepository');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\Resource\Item');
    }

    function it_has_am_url()
    {
        $this->getUrl()->shouldReturn('api/taxonmies/');
    }

    function it_has_a_query_repository()
    {
        $this->getQueryRepository()->shouldReturn('My/Custom/QueryRepository');
    }
}
