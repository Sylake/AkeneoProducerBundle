<?php

namespace Tests\Sylake\AkeneoProducerBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Sylake\AkeneoProducerBundle\DependencyInjection\Compiler\ItemProjectorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class ItemProjectorPassTest extends AbstractCompilerPassTestCase
{
    /** {@inheritdoc} */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ItemProjectorPass());
    }

    /**
     * @test
     */
    public function it_collects_tagged_item_projectors()
    {
        $this->setDefinition('sylake_akeneo_producer.connector.item_projector', new Definition());
        $this->setDefinition(
            'acme.item_projector',
            (new Definition())->addTag(
                'sylake_akeneo_producer.connector.item_projector',
                ['supported_class' => \Traversable::class]
            )
        );

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            'sylake_akeneo_producer.connector.item_projector',
            'addItemProjector',
            [\Traversable::class, new Reference('acme.item_projector')]
        );
    }
}
