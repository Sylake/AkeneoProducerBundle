<?php

namespace Sylake\AkeneoProducerBundle\Listener;

interface ItemProjectorInterface
{
    /**
     * @param object $item
     *
     * @return void
     */
    public function __invoke($item);
}
