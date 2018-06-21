<?php

namespace Gweb\TecdocBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function __construct()
    {
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gweb_tecdoc');

        $rootNode
            ->children()
                ->arrayNode('dir')
                    ->children()
                        ->arrayNode('download')
                            ->children()
                                ->scalarNode('reference')->end()
                                ->scalarNode('supplier')->end()
                                ->scalarNode('media')->end()
                            ->end()
                        ->end()
                        ->arrayNode('data')
                            ->children()
                                ->scalarNode('reference')
                                    ->defaultValue('%kernel.project_dir%/var/tecdoc/data/reference')
                                ->end()
                                ->scalarNode('supplier')
                                    ->defaultValue('%kernel.project_dir%/var/tecdoc/data/supplier')
                                ->end()
                                ->scalarNode('media')
                                    ->defaultValue('%kernel.project_dir%/var/tecdoc/data/media')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('translator')
                    ->children()
                        ->booleanNode('autoload')->defaultTrue()->end()
                        ->scalarNode('default_locale')->defaultValue('en')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
