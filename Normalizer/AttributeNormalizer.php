<?php

namespace Sylius\Bundle\SylakimBundle\Normalizer;

use Pim\Bundle\CatalogBundle\Model\AbstractAttribute;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class AttributeNormalizer implements NormalizerInterface
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
