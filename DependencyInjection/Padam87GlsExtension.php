<?php

namespace Padam87\GlsBundle\DependencyInjection;

use Padam87\GlsBundle\Service\ParcelApi;
use Padam87\GlsBundle\Service\ParcelGeneratorInterface;
use Padam87\GlsBundle\Service\PodDownloadApi;
use Padam87\GlsBundle\Service\TrackingApi;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class Padam87GlsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $definition = $container->getDefinition(ParcelApi::class);
        $definition->addMethodCall('setConfig', [$config]);

        $definition = $container->getDefinition(TrackingApi::class);
        $definition->addMethodCall('setConfig', [$config]);

        $definition = $container->getDefinition(PodDownloadApi::class);
        $definition->addMethodCall('setConfig', [$config]);

        $container->registerForAutoconfiguration(ParcelGeneratorInterface::class)->addTag('padam87_gls.parcel_genarator');
    }
}
