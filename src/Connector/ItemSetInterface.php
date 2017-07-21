<?php

namespace Sylake\AkeneoProducerBundle\Connector;

interface ItemSetInterface
{
    /**
     * @param object $item
     *
     * @return void
     *
     * @throws \DomainException
     */
    public function add($item);

    /**
     * @return object[]
     */
    public function all();

    /**
     * @return void
     */
    public function clear();
}
