<?php

namespace Tests\Sylake\Sylakim\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Sylake\Sylakim\DependencyInjection\SylakeSylakimExtension;

final class SylakeSylakimExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @test
     */
    public function it_registers_parameters_related_to_sylius_api()
    {
        $this->load([
            'api_url' => 'https://api.sylius.local',
            'api_public_id' => 'KRZYSZTOF',
            'api_secret' => 'KRAWCZYK',
        ]);

        $this->assertContainerBuilderHasParameter('sylake_sylakim.api_url', 'https://api.sylius.local');
        $this->assertContainerBuilderHasParameter('sylake_sylakim.api_public_id', 'KRZYSZTOF');
        $this->assertContainerBuilderHasParameter('sylake_sylakim.api_secret', 'KRAWCZYK');
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [
            new SylakeSylakimExtension(),
        ];
    }
}
