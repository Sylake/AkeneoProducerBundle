<?php

namespace Sylake\AkeneoProducerBundle;

use Sylake\AkeneoProducerBundle\DependencyInjection\Compiler\ItemProjectorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SylakeAkeneoProducerBundle extends Bundle
{
    /** {@inheritdoc} */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ItemProjectorPass());
    }
}
