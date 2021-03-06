<?php

namespace BBIT\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bbit_blog');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->node('extend_template', 'scalar')
                ->end()
                ->node('disqus_shortname', 'scalar')
                ->end()
                ->node('btn_class', 'scalar')->defaultValue('btn btn-primary')
                ->end()
                ->node('addthis_pubid', 'scalar')
                ->end()
                ->variableNode('eko_feed')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
