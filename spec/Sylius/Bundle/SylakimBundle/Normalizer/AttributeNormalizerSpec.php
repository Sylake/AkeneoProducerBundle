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

use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Prophecy\Argument;

class AttributeNormalizerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['xml', 'json']);
    }

    function it_is_a_normalizer()
    {
        $this->beAnInstanceOf('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_supports_json_normalization_of_attribute(AbstractAttribute $attribute)
    {
        $this->supportsNormalization($attribute, 'json')->shouldReturn(true);
    }

    function it_supports_xml_normalization_of_attribute(AbstractAttribute $attribute)
    {
        $this->supportsNormalization($attribute, 'xml')->shouldReturn(true);
    }

    function it_does_not_support_other_normalizations(AbstractAttribute $attribute)
    {
        $this->supportsNormalization($attribute, 'csv')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($attribute), 'xml')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($attribute), 'json')->shouldReturn(false);
    }

    function it_normalizes_an_attribute(AbstractAttribute $attribute)
    {
        $attribute->getCode()->willReturn('foo');
        $attribute->getAttributeType()->willReturn('bar');

        $this->normalize($attribute, 'json')->shouldReturn(['code' => 'foo', 'type' => 'bar']);
    }
}
