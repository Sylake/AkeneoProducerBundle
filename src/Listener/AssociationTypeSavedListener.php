<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Pim\Component\Catalog\Model\AssociationTypeInterface;

final class AssociationTypeSavedListener
{
    /** @var ItemProjectorInterface */
    private $associationTypeProjector;

    public function __construct(ItemProjectorInterface $associationTypeProjector)
    {
        $this->associationTypeProjector = $associationTypeProjector;
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

        $this->associationTypeProjector->__invoke($associationType);
    }
}
