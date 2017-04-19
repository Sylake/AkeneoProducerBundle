<?php

namespace Sylake\Sylakim\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class SylakeSylakimExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $container->setParameter('sylake_sylakim.api_url', $config['api_url']);
        $container->setParameter('sylake_sylakim.api_public_id', $config['api_public_id']);
        $container->setParameter('sylake_sylakim.api_secret', $config['api_secret']);

        $loader->load('services.xml');
    }
}
