<?php

namespace BBIT\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BBITBlogExtension extends Extension implements PrependExtensionInterface
{

    public function prepend(ContainerBuilder $container)
    {



        // get all bundles
        $bundles = $container->getParameter('kernel.bundles');
        // determine if AcmeGoodbyeBundle is registered

            // disable AcmeGoodbyeBundle in bundles

            $configs = $container->getExtensionConfig($this->getAlias());
            $config = $this->processConfiguration(new Configuration(), $configs);

            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'eko_feed':
                        // set use_acme_goodbye to false in the config of
                        // acme_something and acme_other note that if the user manually
                        // configured use_acme_goodbye to true in the app/config/config.yml
                        // then the setting would in the end be true and not false
                        $container->prependExtensionConfig($name, $config['eko_feed']);
                        break;
                }
            }



    }



    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('bbit_blog.extend_template', $config['extend_template']);
        $container->setParameter('bbit_blog.disqus_shortname', $config['disqus_shortname']);
        $container->setParameter('bbit_blog.btn_class', $config['btn_class']);
        $container->setParameter('bbit_blog.addthis_pubid', $config['addthis_pubid']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
