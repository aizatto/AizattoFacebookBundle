<?php

namespace Aizatto\Bundle\FacebookBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AizattoFacebookExtension extends Extension
{

  /**
   * {@inheritDoc}
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);
    foreach(array('user', 'facebook_user', 'facebook_friend') as $key) {
      $key = $key.'_class';
      if (!isset($config[$key])) {
        continue;
      }

      $value = $config[$key];
      $key = 'aizatto_facebook.'.$key;
      $container->setParameter($key, $value);
    }

    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.yml');
  }
}
