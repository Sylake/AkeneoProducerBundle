<?php

namespace spec\Sylius\Bundle\SylakimBundle\Writer;

use PhpSpec\ObjectBehavior;

class SyliusWriterSpec extends ObjectBehavior
{
    function it_is_an_item_writer()
    {
        $this->beAnInstanceOf('Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface');
    }

    function it_is_a_step_execution()
    {
        $this->beAnInstanceOf('Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface');
    }

    function it_needs_some_configuration()
    {
        $this->getConfigurationFields()->shouldHaveKey('host');
        $this->getConfigurationFields()->shouldHaveKey('username');
        $this->getConfigurationFields()->shouldHaveKey('apiKey');
        $this->getConfigurationFields()->shouldHaveKey('httpLogin');
        $this->getConfigurationFields()->shouldHaveKey('httpPassword');
        $this->getConfigurationFields()->shouldHaveKey('format');
    }
}
