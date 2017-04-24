<?php

namespace Sylake\Sylakim\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylake_sylakim');

        $rootNode
            ->children()
                ->scalarNode('api_url')
                    ->isRequired()->cannotBeEmpty()
                    ->info('The URL of the Sylius API.')
                ->end()
                ->scalarNode('api_public_id')
                    ->isRequired()->cannotBeEmpty()
                    ->info('The public ID of the Sylius API. See http://docs.sylius.org/en/latest/api/authorization.html#oauth2.')
                ->end()
                ->scalarNode('api_secret')
                    ->isRequired()->cannotBeEmpty()
                    ->info('The secret of the Sylius API. See http://docs.sylius.org/en/latest/api/authorization.html#oauth2.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
