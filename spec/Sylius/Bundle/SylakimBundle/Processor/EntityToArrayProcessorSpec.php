<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\SylakimBundle\Processor;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EntityToArrayProcessorSpec extends ObjectBehavior
{
    function let(NormalizerInterface $normalizer)
    {
        $this->beConstructedWith($normalizer);
    }

    function it_calls_the_normalizer_with_an_expected_format($normalizer)
    {
        $normalizer->normalize('bar', 'foo')->willReturn('qux');

        $this->setFormat('foo');
        $this->process('bar')->shouldReturn('qux');
    }

    function it_needs_some_configuration()
    {
        $this->getConfigurationFields()->shouldHaveKey('format');
    }
}
