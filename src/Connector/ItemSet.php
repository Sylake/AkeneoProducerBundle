<?php

namespace Sylake\AkeneoProducerBundle\Connector;

final class ItemSet implements ItemSetInterface
{
    /** @var object[] */
    private $items = [];

    /** {@inheritdoc} */
    public function add($item)
    {
        if (!is_object($item)) {
            throw new \InvalidArgumentException('Object storage accepts only objects!');
        }

        if (in_array($item, $this->items, true)) {
            return;
        }

        $this->items[] = $item;
    }

    /** {@inheritdoc} */
    public function all()
    {
        return $this->items;
    }

    /** {@inheritdoc} */
    public function clear()
    {
        $this->items = [];
    }
}
