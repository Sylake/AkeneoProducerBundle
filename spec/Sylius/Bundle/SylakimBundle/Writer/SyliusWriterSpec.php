<?php

namespace spec\Sylius\Bundle\SylakimBundle\Writer;

use PhpSpec\ObjectBehavior;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
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
        $this->getConfigurationFields()->shouldHaveKey('wsdlUrl');
        $this->getConfigurationFields()->shouldHaveKey('username');
        $this->getConfigurationFields()->shouldHaveKey('apiKey');
        $this->getConfigurationFields()->shouldHaveKey('httpLogin');
        $this->getConfigurationFields()->shouldHaveKey('httpPassword');
        $this->getConfigurationFields()->shouldHaveKey('format');
    }
}
