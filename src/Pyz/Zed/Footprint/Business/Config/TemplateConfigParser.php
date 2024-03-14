<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Business\Config;

use Generated\Shared\Transfer\FootprintOptionTransfer;
use Pyz\Zed\Footprint\Business\Exception\ConfigParserException;
use Pyz\Zed\Footprint\FootprintConfig;
use Symfony\Component\Yaml\Yaml;
use Throwable;

class TemplateConfigParser implements TemplateConfigParserInterface
{
    public function __construct(
        protected readonly Yaml $yamlParser,
        protected readonly FootprintConfig $config
    ) {
    }

    public function parseConfig(string $templateName): array
    {
        $configPath =
            $this->config->getFootprintTemplatePath()
            . DIRECTORY_SEPARATOR
            . $templateName
            . DIRECTORY_SEPARATOR
            . $this->config->getFootprintConfigName();

        try {
            /** @var array<array> $templateConfigData */
            $templateConfigData = $this->yamlParser::parseFile($configPath);
        } catch (Throwable $e) {
            throw new ConfigParserException(
                sprintf(
                    'Cannot parse template config "%s". Error %s.',
                    $configPath,
                    $e->getMessage()
                ),
                previous: $e,
            );
        }

        return $this->createFootprintOptionTransfers($templateConfigData);
    }

    /**
     * @param array<array> $templateConfigData
     *
     * @return array<\Generated\Shared\Transfer\FootprintOptionTransfer>
     */
    protected function createFootprintOptionTransfers(array $templateConfigData): array
    {
        $footprintOptionTransfers = [];
        foreach ($templateConfigData as $templateConfigDataItem) {
            $footprintOptionTransfers[] = (new FootprintOptionTransfer())
                ->setName(key($templateConfigDataItem))
                ->setLabel(current($templateConfigDataItem));
        }

        return $footprintOptionTransfers;
    }
}
