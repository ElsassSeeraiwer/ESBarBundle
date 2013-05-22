<?php

namespace ElsassSeeraiwer\ESBarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Kevin Eyermann <kevin.eyermann@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elsass_seeraiwer_es_bar');

        $rootNode
            ->children()
                ->booleanNode('toolbar')->defaultTrue()->end()
                ->booleanNode('locale_tool')->defaultTrue()->end()
                ->booleanNode('registration')->defaultTrue()->end()
                ->scalarNode('position')
                    ->defaultValue('top')
                    ->validate()
                        ->ifNotInArray(array('bottom', 'top'))
                        ->thenInvalid('The CSS position %s is not supported')
                    ->end()
                ->end()
                ->arrayNode('templates')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('controller')->end()
                            ->scalarNode('template')->end()
                            ->variableNode('parameters')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
