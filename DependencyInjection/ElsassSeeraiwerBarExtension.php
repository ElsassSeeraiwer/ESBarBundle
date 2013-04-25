<?php

namespace Elsass\SeeraiwerBarBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Elsass\SeeraiwerBarBundle\EventListener\ToolBarListener;

/**
 * This is the class that loads and manages your the configuration
 *
 * @author Kevin Eyermann <kevin.eyermann@gmail.com>
 */
class ElsassSeeraiwerBarExtension extends Extension
{
    /**
     * Loads the web profiler configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('toolbar.xml');

        if (!$config['toolbar']) {
            $mode = ToolBarListener::DISABLED;
        } else {
            $mode = ToolBarListener::ENABLED;
        }

        $container->setParameter('elsass_seeraiwer_bar.toolbar.mode', $mode);
        $container->setParameter('elsass_seeraiwer_bar.toolbar.templates', $config['templates']);
        $container->setParameter('elsass_seeraiwer_bar.toolbar.position', $config['position']);
    }
}
