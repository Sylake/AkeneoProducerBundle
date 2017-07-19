<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Akeneo\Component\Classification\Model\CategoryInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

final class CategorySavedListener
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

        if (!$category instanceof CategoryInterface) {
            return;
        }

        $this->itemSet->add($category);
    }
}
