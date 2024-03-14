<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class FootprintConfig extends AbstractBundleConfig
{
    protected const FOOTPRINT_TEMPLATE_PATH = APPLICATION_ROOT_DIR . '/templates';

    protected const FOOTPRINT_CONFIG_NAME = 'config.yaml';

    public function getFootprintTemplatePath() :string
    {
        return static::FOOTPRINT_TEMPLATE_PATH;
    }

    public function getFootprintConfigName() :string
    {
        return static::FOOTPRINT_CONFIG_NAME;
    }
}
