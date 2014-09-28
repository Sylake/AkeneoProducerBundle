<?php

namespace spec\Sylius\Bundle\SylakimBundle\Normalizer;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Entity\Family;
use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Prophecy\Argument;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class FamilyNormalizerSpec extends ObjectBehavior
{
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
