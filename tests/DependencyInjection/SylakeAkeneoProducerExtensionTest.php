<?php

namespace Tests\Sylake\AkeneoProducerBundle\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Sylake\AkeneoProducerBundle\DependencyInjection\SylakeAkeneoProducerExtension;

final class SylakeAkeneoProducerExtensionTest extends AbstractExtensionTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [new SylakeAkeneoProducerExtension()];
    }

    /**
     * @test
     */
    public function it_stores_supported_locales_as_a_parameter()
    {
        $this->load(['locales' => ['pl_PL']]);

        $this->compile();

        $this->assertContainerBuilderHasParameter('sylake_akeneo_producer.config.locales', ['pl_PL']);
    }
}
