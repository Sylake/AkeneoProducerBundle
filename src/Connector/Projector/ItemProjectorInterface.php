<?php

namespace Sylake\AkeneoProducerBundle\Connector\Projector;

interface ItemProjectorInterface
{
    /**
     * @param object $item
     *
     * @return void
     */
    public function __invoke($item);
}
