<?php

namespace Gweb\TecdocBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class GwebTecdocExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
          $container,
          new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $container->setParameter('gweb_tecdoc.dir_download_reference', $config['dir']['download']['reference']);
        $container->setParameter('gweb_tecdoc.dir_download_supplier', $config['dir']['download']['supplier']);
        $container->setParameter('gweb_tecdoc.dir_download_media', $config['dir']['download']['media']);
        $container->setParameter('gweb_tecdoc.dir_data_reference', $config['dir']['data']['reference']);
        $container->setParameter('gweb_tecdoc.dir_data_supplier', $config['dir']['data']['supplier']);
        $container->setParameter('gweb_tecdoc.dir_data_media', $config['dir']['data']['media']);

        $container->setParameter('gweb_tecdoc.translator_autoload', $config['translator']['autoload']);
        $container->setParameter('gweb_tecdoc.translator_default_locale', $config['translator']['default_locale']);
    }
}
