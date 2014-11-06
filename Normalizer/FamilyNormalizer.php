<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylake\Bundle\SylakimBundle\Normalizer;

use Doctrine\Common\Collections\Collection;
use Pim\Bundle\CatalogBundle\Entity\Family;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer that defines what part of family should be exported to Sylius
 *
 * @author Romain Monceau <monceau.romain@gmail.com>
 */
class FamilyNormalizer implements NormalizerInterface
{
    /** @var string[] */
    protected $supportedFormats;

    /**
     * @param string[] $supportedFormats
     */
    public function __construct(array $supportedFormats)
    {
        $this->supportedFormats = $supportedFormats;
    }

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
     * @param Collection $attributes
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
