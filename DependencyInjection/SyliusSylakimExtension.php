<?php

namespace Sylius\Bundle\SylakimBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 *
 * @author    <AUTHOR>
 * @copyright <COPYRIGHT>
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class SyliusSylakimExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('normalizers.yml');
        $loader->load('processors.yml');
        $loader->load('readers.yml');
        $loader->load('serializers.yml');
        $loader->load('writers.yml');
    }
}
