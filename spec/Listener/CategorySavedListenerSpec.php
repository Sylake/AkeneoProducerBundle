<?php

namespace spec\Sylake\AkeneoProducerBundle\Listener;

use Akeneo\Component\Classification\Model\CategoryInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylake\AkeneoProducerBundle\Listener\ItemProjectorInterface;

final class CategorySavedListenerSpec extends ObjectBehavior
{
    function let(ItemProjectorInterface $categoryProjector)
    {
        $this->beConstructedWith($categoryProjector);
    }

    function it_ignores_items_not_being_an_category(
        ItemProjectorInterface $categoryProjector,
        ObjectManager $objectManager
    ) {
        $categoryProjector->__invoke(Argument::any())->shouldNotBeCalled();

        $this(new LifecycleEventArgs(new \stdClass(), $objectManager->getWrappedObject()));
    }

    function it_projects_item_being_an_category(
        ItemProjectorInterface $categoryProjector,
        ObjectManager $objectManager,
        CategoryInterface $category
    ) {
        $categoryProjector->__invoke($category)->shouldBeCalled();

        $this(new LifecycleEventArgs($category->getWrappedObject(), $objectManager->getWrappedObject()));
    }
}
