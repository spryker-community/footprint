<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Symfony\Component\Yaml\Yaml;

class FootprintDependencyProvider extends AbstractBundleDependencyProvider
{
    public const YML_PARSER = 'YML_PARSER';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        return $container;
    }

    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container->set(static::YML_PARSER, function (): Yaml {
            return new Yaml();
        });

        return $container;
    }
}
