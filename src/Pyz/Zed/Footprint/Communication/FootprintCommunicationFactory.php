<?php declare(strict_types = 1);

namespace Pyz\Zed\Footprint\Communication;


use Pyz\Zed\Footprint\Business\Config\TemplateConfigParser;
use Pyz\Zed\Footprint\Business\Config\TemplateConfigParserInterface;
use Pyz\Zed\Footprint\FootprintDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Yaml\Yaml;

/**
 * @method \Pyz\Zed\Footprint\FootprintConfig getConfig()
 * @method \Pyz\Zed\Footprint\Business\FootprintFacadeInterface getFacade()
 */
class FootprintCommunicationFactory extends AbstractCommunicationFactory
{
    public function createTemplateConfigParser(): TemplateConfigParserInterface
    {
        return new TemplateConfigParser(
            $this->getYmlParser(),
            $this->getConfig()
        );
    }

    protected function getYmlParser(): Yaml
    {
        return $this->getProvidedDependency(FootprintDependencyProvider::YML_PARSER);
    }
}
