<?php

namespace Sylius\Bundle\SylakimBundle\Writer;

/**
 * Sylius writer class that calls Sylius REST API
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class SyliusWriter extends AbstractWriter
{
    /**
     * Process the supplied data element. Will not be called with any null items
     * in normal operation.
     *
     * @param array $items The list of items to write
     *                     FIXME: array is not maybe the best structure to hold the items. Investigate this point.
     *
     * @throw             InvalidItemException if there is a warning, step execution will continue to the
     *                    next item.
     * @throws \Exception if there are errors. The framework will catch the
     *                    exception and convert or rethrow it as appropriate.
     */
    public function write(array $items)
    {
        var_dump($items);
        // TODO
    }
}
