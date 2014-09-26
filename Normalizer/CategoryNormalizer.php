<?php

namespace Sylius\Bundle\SylakimBundle\Normalizer;

use Pim\Bundle\CatalogBundle\Model\CategoryInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class CategoryNormalizer implements NormalizerInterface
{
    /** @var string[] */
    protected $supportedFormats = array('json', 'xml');

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = ['code' => $object->getCode()];
        if (null !== $object->getParent()) {
            $data['parent'] = $object->getParent()->getCode();
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CategoryInterface && in_array($format, $this->supportedFormats);
    }
}
