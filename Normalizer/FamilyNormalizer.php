<?php

namespace Sylius\Bundle\SylakimBundle\Normalizer;

use Doctrine\Common\Collections\Collection;
use Pim\Bundle\CatalogBundle\Entity\Family;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class FamilyNormalizer implements NormalizerInterface
{
    /** @var string[] */
    protected $supportedFormats = array('json', 'xml');

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'code' => $object->getCode(),
            'attributes' => $this->normalizeAttributes($object->getAttributes())
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Family && in_array($format, $this->supportedFormats);
    }

    /**
     * Normalize family attributes
     *
     * @param array $attributes
     *
     * @return array
     */
    protected function normalizeAttributes(Collection $attributes)
    {
        $attributeCodes = [];
        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getCode();
        }

        return $attributeCodes;
    }
}
