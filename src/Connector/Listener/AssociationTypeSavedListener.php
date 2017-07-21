<?php

namespace Sylake\AkeneoProducerBundle\Connector\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Pim\Component\Catalog\Model\AssociationTypeInterface;
use Sylake\AkeneoProducerBundle\Connector\ItemSetInterface;

final class AssociationTypeSavedListener
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
        $associationType = $event->getObject();

        if (!$associationType instanceof AssociationTypeInterface) {
            return;
        }

        $this->itemSet->add($associationType);
    }
}
