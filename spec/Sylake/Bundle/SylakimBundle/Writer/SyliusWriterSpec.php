<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylake\Bundle\SylakimBundle\Writer;

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
