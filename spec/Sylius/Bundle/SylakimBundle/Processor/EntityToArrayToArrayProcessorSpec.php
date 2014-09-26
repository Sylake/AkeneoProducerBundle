<?php

namespace spec\Sylius\Bundle\SylakimBundle\Processor;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class EntityToArrayProcessorSpec extends ObjectBehavior
{
    function let(NormalizerInterface $normalizer)
    {
        $this->beConstructedWith($normalizer);
    }

    function it_calls_the_normalizer_with_an_expected_format($normalizer)
    {
        $normalizer->normalize('bar', 'foo')->willReturn('qux');

        $this->process('bar')->shouldReturn('qux');
    }
}
