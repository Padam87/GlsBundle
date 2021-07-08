<?php

namespace Padam87\GlsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('padam87_gls');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('wsdl')
                    ->defaultValue('https://api.mygls.hu/ParcelService.svc?singleWsdl')
                ->end()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('senderid')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                    ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
