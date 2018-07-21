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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('padam87_gls');

        $rootNode
            ->children()
                ->scalarNode('parcel_wsdl')
                    ->defaultValue('https://online.gls-hungary.com/webservices/soap_server.php?wsdl')
                ->end()
                ->scalarNode('tracking_url')
                    ->defaultValue('https://gls-group.eu/app/service/open/rest/HU/en/rstt001?match={code}')
                ->end()
                ->scalarNode('pod_download_url')
                    ->defaultValue('http://online.gls-hungary.com/tt_getPodsClass.php?userID={userid}&senderID={senderid}&pclFrom={code_from}&pclTo={code_to}&lang=hu&directDownload=1&fileType=PDF')
                ->end()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('userid')->example('required for pod download, GLS usually forgets to provide it unless you ask')->isRequired()->cannotBeEmpty()->end()
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
