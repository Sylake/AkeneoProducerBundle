<?php

namespace spec\Sylius\Bundle\SylakimBundle\Normalizer;

use PhpSpec\ObjectBehavior;
use Pim\Bundle\CatalogBundle\Model\CategoryInterface;
use Prophecy\Argument;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class CategoryNormalizerSpec extends ObjectBehavior
{
    function it_is_a_normalizer()
    {
        $this->beAnInstanceOf('Symfony\Component\Serializer\Normalizer\NormalizerInterface');
    }

    function it_supports_json_normalization_of_category(CategoryInterface $category)
    {
        $this->supportsNormalization($category, 'json')->shouldReturn(true);
    }

    function it_supports_xml_normalization_of_category(CategoryInterface $category)
    {
        $this->supportsNormalization($category, 'xml')->shouldReturn(true);
    }

    function it_does_not_support_other_normalizations(CategoryInterface $category)
    {
        $this->supportsNormalization($category, 'csv')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($category), 'xml')->shouldReturn(false);
        $this->supportsNormalization(Argument::not($category), 'json')->shouldReturn(false);
    }

    function it_normalizes_a_category(CategoryInterface $category, CategoryInterface $parent)
    {
        $category->getCode()->willReturn('foo');
        $category->getParent()->willReturn($parent);
        $parent->getCode()->willReturn('bar');

        $this->normalize($category, 'json')->shouldReturn(['code' => 'foo', 'parent' => 'bar']);
    }

    function it_normalizes_a_root_category(CategoryInterface $category)
    {
        $category->getCode()->willReturn('foo');
        $category->getParent()->willReturn(null);

        $this->normalize($category, 'json')->shouldReturn(['code' => 'foo']);
    }
}
