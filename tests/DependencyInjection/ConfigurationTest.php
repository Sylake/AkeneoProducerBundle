<?php

namespace Tests\Sylake\AkeneoProducerBundle\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Sylake\AkeneoProducerBundle\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    /**
     * {@inheritdoc}
     */
    protected function getConfiguration()
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function it_specifies_default_supported_locales()
    {
        $this->assertProcessedConfigurationEquals([[]], ['locales' => ['en_GB', 'de_DE']], 'locales');
    }

    /**
     * @test
     */
    public function its_supported_locales_can_be_changed()
    {
        $this->assertProcessedConfigurationEquals(
            [['locales' => ['en_US']]],
            ['locales' => ['en_US']],
            'locales'
        );
    }

    /**
     * @test
     */
    public function its_supported_locales_can_be_overwritten()
    {
        $this->assertProcessedConfigurationEquals(
            [
                ['locales' => ['en_US']],
                ['locales' => ['pl_PL']],
            ],
            ['locales' => ['pl_PL']],
            'locales'
        );
    }
}
