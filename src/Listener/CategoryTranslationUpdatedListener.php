<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Akeneo\Component\Classification\Model\CategoryInterface;
use Pim\Component\Catalog\Model\CategoryTranslationInterface;

final class CategoryTranslationUpdatedListener
{
    /** @var ItemProjectorInterface */
    private $categoryProjector;

    /** @var CategoryInterface[] */
    private static $producedObjects = [];

    public function __construct(ItemProjectorInterface $categoryProjector)
    {
        $this->categoryProjector = $categoryProjector;
    }

    public function postUpdate(LifecycleEventArgs $event)
    {
        $this($event);
    }

    public function __invoke(LifecycleEventArgs $event)
    {
        $categoryTranslation = $event->getObject();

        if (!$categoryTranslation instanceof CategoryTranslationInterface) {
            return;
        }

        /** @var CategoryInterface $category */
        $category = $categoryTranslation->getForeignKey();

        // All translations are persisted to category, no need to produce it multiple times
        if (in_array($category, self::$producedObjects, true)) {
            return;
        }

        self::$producedObjects[] = $category;

        $this->categoryProjector->__invoke($category);
    }
}
