<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Pim\Component\Catalog\Model\AttributeInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class AttributeSavedListener
{
    /** @var ItemProjectorInterface */
    private $attributeProjector;

    /** @var ItemProjectorInterface */
    private $attributeOptionProjector;

    public function __construct(ItemProjectorInterface $attributeProjector, ItemProjectorInterface $attributeOptionProjector)
    {
        $this->attributeProjector = $attributeProjector;
        $this->attributeOptionProjector = $attributeOptionProjector;
    }

    public function __invoke(GenericEvent $event)
    {
        $attribute = $event->getSubject();

        if (!$attribute instanceof AttributeInterface) {
            return;
        }

        $this->attributeProjector->__invoke($attribute);

        foreach ($attribute->getOptions() as $attributeOption) {
            $this->attributeOptionProjector->__invoke($attributeOption);
        }
    }
}
