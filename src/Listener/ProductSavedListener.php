<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Pim\Component\Catalog\Model\ProductInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class ProductSavedListener
{
    /** @var ItemSetInterface */
    private $itemSet;

    public function __construct(ItemSetInterface $itemSet)
    {
        $this->itemSet = $itemSet;
    }

    public function __invoke(GenericEvent $event)
    {
        $product = $event->getSubject();

        if (!$product instanceof ProductInterface) {
            return;
        }

        $this->itemSet->add($product);
    }
}
