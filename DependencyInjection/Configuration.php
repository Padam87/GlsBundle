<?php

namespace Padam87\GlsBundle\DependencyInjection;

use Padam87\GlsBundle\Service\ParcelApi;
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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('padam87_gls');

        $rootNode
            ->children()
                ->scalarNode('class')->defaultValue(ParcelApi::class)->end()
                ->scalarNode('wsdl')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('tracking_url')->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('senderid')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                    ->ignoreExtraKeys(false)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
