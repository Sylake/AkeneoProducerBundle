<?php

/*
 * This file is part of the Sylakim package.
 *
 * (c) Sylake
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylake\Bundle\SylakimBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manage Sylius connector bundle configuration
 *
 * @author Romain Monceau <monceau.romain@gmail.com>
 */
class SylakeSylakimExtension extends Extension
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
