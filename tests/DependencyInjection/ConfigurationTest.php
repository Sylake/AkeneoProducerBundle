<?php

namespace Tests\Sylake\Sylakim\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Sylake\Sylakim\DependencyInjection\Configuration;

final class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    use ConfigurationTestCaseTrait;

    /**
     * @test
     */
    public function api_url_is_required_and_cannot_be_empty()
    {
        $this->assertPartialConfigurationIsInvalid([
            []
        ], 'api_url');

        $this->assertPartialConfigurationIsInvalid([
            ['api_url' => '']
        ], 'api_url');
    }

    /**
     * @test
     */
    public function api_public_id_is_required_and_cannot_be_empty()
    {
        $this->assertPartialConfigurationIsInvalid([
            []
        ], 'api_public_id');

        $this->assertPartialConfigurationIsInvalid([
            ['api_public_id' => '']
        ], 'api_public_id');
    }

    /**
     * @test
     */
    public function api_secret_is_required_and_cannot_be_empty()
    {
        $this->assertPartialConfigurationIsInvalid([
            []
        ], 'api_secret');

        $this->assertPartialConfigurationIsInvalid([
            ['api_secret' => '']
        ], 'api_secret');
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfiguration()
    {
        return new Configuration();
    }
}
