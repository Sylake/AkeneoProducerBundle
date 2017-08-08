<?php

namespace Sylake\AkeneoProducerBundle\Connector\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Pim\Component\Catalog\Model\FamilyInterface;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class FamilySavedListener
{
    /** @var ItemSetInterface */
    private $itemSet;

    public function __construct(ItemSetInterface $itemSet)
    {
        $this->itemSet = $itemSet;
    }

    public function postPersist(LifecycleEventArgs $event)
    {
        $this($event);
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this($event);
    }

    public function __invoke(LifecycleEventArgs $event)
    {
        $category = $event->getObject();

        if (!$category instanceof FamilyInterface) {
            return;
        }

        $this->itemSet->add($category);
    }
}
