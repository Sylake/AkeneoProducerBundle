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

use Pim\Bundle\CatalogBundle\Model\CategoryInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer that defines what part of category should be exported to Sylius
 *
 * @author Romain Monceau <monceau.romain@gmail.com>
 */
class CategoryNormalizer implements NormalizerInterface
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
