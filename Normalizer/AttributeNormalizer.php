<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylakim
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\SylakimBundle\Normalizer;

use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer that defines what part of attribute should be exported to Sylius
 *
 * @author Romain Monceau <monceau.romain@gmail.com>
 */
class AttributeNormalizer implements NormalizerInterface
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
            'type' => $object->getAttributeType()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof AbstractAttribute && in_array($format, $this->supportedFormats);
    }
}
