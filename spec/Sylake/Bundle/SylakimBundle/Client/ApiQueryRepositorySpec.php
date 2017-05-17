<?php

namespace spec\Sylake\Bundle\SylakimBundle\Client;

use Guzzle\Http\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\Bundle\SylakimBundle\Client\Resource\ItemManager;
use Sylake\Bundle\SylakimBundle\Client\Transformer\ObjectToArrayTransformer;

class ApiQueryRepositorySpec extends ObjectBehavior
{
    function let(Client $client, ItemManager $itemManager, ObjectToArrayTransformer $transformer)
    {
        $this->beConstructedWith($client, $itemManager, $transformer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylake\Bundle\SylakimBundle\Client\ApiQueryRepository');
    }

    function it_finds_a_resource_by_identifier()
    {
        $this->find();
    }

    function it_finds_resources_by_criteria()
    {
        $this->findBy();
    }

    function it_finds_one_resource_by_criteria()
    {
        $this->findOneBy();
    }

    function it_finds_all_resources()
    {
        $this->findAll();
    }
}
