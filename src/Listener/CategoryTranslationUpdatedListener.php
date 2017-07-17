<?php

namespace Sylake\AkeneoProducerBundle\Listener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Akeneo\Component\Classification\Model\CategoryInterface;
use Pim\Component\Catalog\Model\CategoryTranslationInterface;

final class CategoryTranslationUpdatedListener
{
    /** @var ItemProjectorInterface */
    private $categoryProjector;

    public function __construct(ItemProjectorInterface $categoryProjector)
    {
        $this->categoryProjector = $categoryProjector;
    }

    public function __invoke(LifecycleEventArgs $event)
    {
        $categoryTranslation = $event->getObject();

        if (!$categoryTranslation instanceof CategoryTranslationInterface) {
            return;
        }

        /** @var CategoryInterface $category */
        $category = $categoryTranslation->getForeignKey();

        $this->categoryProjector->__invoke($category);
    }
}
