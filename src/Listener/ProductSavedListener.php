<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Pim\Component\Catalog\Model\ProductInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ProductSavedListener
{
    /** @var ItemProjectorInterface */
    private $productProjector;

    public function __construct(ItemProjectorInterface $productProjector)
    {
        $this->productProjector = $productProjector;
    }

    public function __invoke(GenericEvent $event)
    {
        $product = $event->getSubject();

        if (!$product instanceof ProductInterface) {
            return;
        }

        $this->productProjector->__invoke($product);
    }
}
