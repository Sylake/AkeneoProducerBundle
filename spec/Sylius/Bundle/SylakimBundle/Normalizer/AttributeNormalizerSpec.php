<?php

namespace spec\Sylius\Bundle\SylakimBundle\Normalizer;

use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Prophecy\Argument;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AttributeNormalizerSpec extends ObjectBehavior
{
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
