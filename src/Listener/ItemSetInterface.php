<?php

declare(strict_types=1);

namespace Sylake\AkeneoProducerBundle\Listener;

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
