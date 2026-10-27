<?php

declare(strict_types=1);

namespace Supportbook\SsmParametersBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('supportbook_ssm_parameters');

        $treeBuilder->getRootNode()
            ->children()
                ->integerNode('cache_lifetime')
                    ->info('Seconds a parameter from SSM is cached, so a rotated value is picked up without a redeploy.')
                    ->min(0)
                    ->defaultValue(600)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
