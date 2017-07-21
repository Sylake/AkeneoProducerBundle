<?php

namespace Sylake\AkeneoProducerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ItemProjectorPass implements CompilerPassInterface
{
    /** {@inheritdoc} */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('sylake_akeneo_producer.connector.item_projector')) {
            return;
        }

        $compositeItemProjectorDefinition = $container->findDefinition('sylake_akeneo_producer.connector.item_projector');

        foreach ($container->findTaggedServiceIds('sylake_akeneo_producer.connector.item_projector') as $id => $tags) {
            foreach ($tags as $tag) {
                if (!array_key_exists('supported_class', $tag)) {
                    throw new \InvalidArgumentException(sprintf(
                        'Service "%s" is tagged with "%s" has to specify "%s" parameter!',
                        $id,
                        'sylake_akeneo_producer.connector.item_projector',
                        'supported_class'
                    ));
                }

                $compositeItemProjectorDefinition->addMethodCall('addItemProjector', [
                    $tag['supported_class'],
                    new Reference($id),
                ]);
            }
        }
    }
}
