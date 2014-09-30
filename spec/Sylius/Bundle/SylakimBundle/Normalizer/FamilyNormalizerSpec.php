<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylakim
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\SylakimBundle\Normalizer;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Entity\Family;
use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Prophecy\Argument;

class FamilyNormalizerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['xml', 'json']);
    }

    function it_is_a_normalizer()
    {
        $this->beAnInstanceOf('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_supports_json_normalization_of_family(Family $family)
    {
        $this->supportsNormalization($family, 'json')->shouldReturn(true);
    }

    function it_supports_xml_normalization_of_family(Family $family)
    {
        $this->supportsNormalization($family, 'xml')->shouldReturn(true);
    }

    function it_does_not_support_other_normalizations(Family $family)
    {
        $this->supportsNormalization($family, 'csv')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($family), 'xml')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($family), 'json')->shouldReturn(false);
    }

    function it_normalizes_a_family(Family $family, Collection $attributes, \Iterator $iterator)
    {
        $family->getCode()->willReturn('foo');
        $family->getAttributes()->willReturn($attributes);
        $attributes->getIterator()->willReturn($iterator);

        $this->normalize($family, 'json')->shouldReturn(['code' => 'foo', 'attributes' => []]);
    }

    function it_normalizes_a_family_and_its_attributes(
        Family $family,
        Collection $attributes,
        \Iterator $iterator,
        AbstractAttribute $attribute1
    ) {
        $family->getCode()->willReturn('bar');
        $family->getAttributes()->willReturn($attributes);
        $attribute1->getCode()->willReturn('att1');

        $attributes->getIterator()->willReturn($iterator);
        $iterator->rewind()->willReturn($attribute1);
        $iterator->current()->willReturn($attribute1);
        $iterator->next()->willReturn($attribute1);
        $valueCount = 1;
        $iterator->valid()->will(
            function () use (&$valueCount) {
                return $valueCount-- > 0;
            }
        );

        $this
            ->normalize($family, 'json')
            ->shouldReturn(['code' => 'bar', 'attributes' => ['att1']]);
    }
}
