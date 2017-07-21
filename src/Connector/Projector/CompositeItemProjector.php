<?php

namespace Sylake\AkeneoProducerBundle\Connector\Projector;

/* final */ class CompositeItemProjector implements ItemProjectorInterface
{
    /** @var array|ItemProjectorInterface[] */
    private $itemProjectors = [];

    /**
     * @param array|ItemProjectorInterface[] $itemProjectors Supported class / interface => item projector
     */
    public function __construct(array $itemProjectors = [])
    {
        foreach ($itemProjectors as $supportedClass => $itemProjector) {
            $this->addItemProjector($supportedClass, $itemProjector);
        }
    }

    public function addItemProjector($supportedClass, ItemProjectorInterface $itemProjector)
    {
        $this->itemProjectors[$supportedClass] = $itemProjector;
    }

    /** {@inheritdoc} */
    public function __invoke($item)
    {
        $this->findItemProjector($item)->__invoke($item);
    }

    private function findItemProjector($item)
    {
        foreach ($this->itemProjectors as $supportedClass => $itemProjector) {
            if ($item instanceof $supportedClass) {
                return $itemProjector;
            }
        }

        throw new \DomainException(sprintf('Could not find item projector for "%s"!', get_class($item)));
    }
}
